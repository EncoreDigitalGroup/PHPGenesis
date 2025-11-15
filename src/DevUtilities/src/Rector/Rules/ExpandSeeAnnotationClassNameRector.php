<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\DevUtilities\Rector\Rules;

use PhpParser\Comment\Doc;
use PhpParser\Node;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\GroupUse;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\Use_;
use PhpParser\Node\Stmt\UseUse;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class ExpandSeeAnnotationClassNameRector extends AbstractRector
{
    public function getNodeTypes(): array
    {
        return [Class_::class];
    }

    /** @param Class_ $node */
    public function refactor(Node $node): ?Node
    {
        $docComment = $node->getDocComment();

        if (!$docComment instanceof Doc) {
            return null;
        }

        $originalText = $docComment->getText();
        $newText = $this->expandSeeAnnotations($originalText, $node);

        if ($newText === $originalText) {
            return null;
        }

        $node->setDocComment(new Doc($newText));

        return $node;
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition("Expand short class names in @see annotations to fully qualified class names", [
            new CodeSample(
                <<<'CODE_SAMPLE'
use App\Services\UserService;

/**
 * @see UserService
 */
class UserController
{
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
use App\Services\UserService;

/**
 * @see \App\Services\UserService
 */
class UserController
{
}
CODE_SAMPLE
            ),
        ]);
    }

    private function expandSeeAnnotations(string $docBlock, Class_ $classNode): string
    {
        // Find all @see annotations
        $pattern = '/@see\s+([^\s\*]+)/';

        $result = preg_replace_callback($pattern, fn (array $matches): string => $this->processSeeMatch($matches, $classNode), $docBlock);

        return is_string($result) ? $result : $docBlock;
    }

    /** @param array<int, string> $matches */
    private function processSeeMatch(array $matches, Class_ $classNode): string
    {
        if (!isset($matches[1]) || !is_string($matches[1])) {
            return $this->getMatchValue($matches);
        }

        $reference = $matches[1];

        if ($this->shouldSkipReference($reference)) {
            return $this->getMatchValue($matches);
        }

        $expandedClassName = $this->resolveClassName($reference, $classNode);

        if ($expandedClassName !== null) {
            return "@see " . $expandedClassName;
        }

        return $this->getMatchValue($matches);
    }

    /** @param array<int, string> $matches */
    private function getMatchValue(array $matches): string
    {
        return is_string($matches[0]) ? $matches[0] : "";
    }

    private function shouldSkipReference(string $reference): bool
    {
        // Skip if already fully qualified
        if (str_starts_with($reference, "\\")) {
            return true;
        }

        // Skip URLs and method references
        return str_contains($reference, "://") || str_contains($reference, "()");
    }

    private function resolveClassName(string $shortName, Class_ $classNode): ?string
    {
        $namespaceNode = $this->findParentNamespace($classNode);

        if (!$namespaceNode instanceof Namespace_) {
            return null;
        }

        // Look for use statements
        $resolvedName = $this->findInUseStatements($shortName, $namespaceNode);

        if ($resolvedName !== null) {
            return $resolvedName;
        }

        // Check current namespace
        return $this->checkCurrentNamespace($shortName, $namespaceNode);
    }

    private function findParentNamespace(Class_ $classNode): ?Namespace_
    {
        /** @var Node|null $parent */
        $parent = $classNode->getAttribute("parent");

        while ($parent !== null) {
            if ($parent instanceof Namespace_) {
                return $parent;
            }

            if (!$parent instanceof Node) {
                break;
            }

            /** @var Node|null $parent */
            $parent = $parent->getAttribute("parent");
        }

        return null;
    }

    private function findInUseStatements(string $shortName, Namespace_ $namespaceNode): ?string
    {
        foreach ($namespaceNode->stmts as $stmt) {
            if ($stmt instanceof Use_) {
                $result = $this->checkUseStatement($shortName, $stmt);
                if ($result !== null) {
                    return $result;
                }
            } elseif ($stmt instanceof GroupUse) {
                $result = $this->checkGroupUseStatement($shortName, $stmt);
                if ($result !== null) {
                    return $result;
                }
            }
        }

        return null;
    }

    private function checkUseStatement(string $shortName, Use_ $useStmt): ?string
    {
        foreach ($useStmt->uses as $use) {
            if (!$use instanceof UseUse) {
                continue;
            }

            $alias = $use->alias instanceof Identifier ? $use->alias->toString() : $use->name->getLast();

            if ($alias === $shortName) {
                return "\\" . $use->name->toString();
            }
        }

        return null;
    }

    private function checkGroupUseStatement(string $shortName, GroupUse $groupUse): ?string
    {
        $prefix = $groupUse->prefix->toString();

        foreach ($groupUse->uses as $use) {
            if (!$use instanceof UseUse) {
                continue;
            }

            $alias = $use->alias instanceof Identifier ? $use->alias->toString() : $use->name->getLast();

            if ($alias === $shortName) {
                return "\\" . $prefix . "\\" . $use->name->toString();
            }
        }

        return null;
    }

    private function checkCurrentNamespace(string $shortName, Namespace_ $namespaceNode): ?string
    {
        if (!$namespaceNode->name instanceof Name) {
            return null;
        }

        $currentNamespace = $namespaceNode->name->toString();

        if ($currentNamespace === "") {
            return null;
        }

        $namespacedName = $currentNamespace . "\\" . $shortName;

        if (class_exists($namespacedName) || interface_exists($namespacedName) || trait_exists($namespacedName)) {
            return "\\" . $namespacedName;
        }

        return null;
    }
}