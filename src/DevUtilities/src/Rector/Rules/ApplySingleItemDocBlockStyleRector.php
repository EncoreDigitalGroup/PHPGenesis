<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\DevUtilities\Rector\Rules;

use PhpParser\Comment\Doc;
use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassConst;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Property;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class ApplySingleItemDocBlockStyleRector extends AbstractRector
{
    public function getNodeTypes(): array
    {
        return [
            Class_::class,
            ClassMethod::class,
            Property::class,
            ClassConst::class,
        ];
    }

    /** @param Class_|ClassMethod|Property|ClassConst $node */
    public function refactor(Node $node): ?Node
    {
        $docComment = $node->getDocComment();

        if (!$docComment instanceof Doc) {
            return null;
        }

        $originalText = $docComment->getText();
        $collapsedText = $this->collapseDocBlock($originalText);

        if ($collapsedText === null || $collapsedText === $originalText) {
            return null;
        }

        // Create new doc comment with collapsed text
        $node->setDocComment(new Doc($collapsedText));

        return $node;
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition("Collapse multi-line docblocks into single line format", [
            new CodeSample(
                <<<'CODE_SAMPLE'
class SomeClass
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @return void
     */
    public function someMethod(): void
    {
    }
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
class SomeClass
{
    /** @var string */
    private string $name;

    /** @return void */
    public function someMethod(): void
    {
    }
}
CODE_SAMPLE
            ),
        ]);
    }

    private function collapseDocBlock(string $docBlock): ?string
    {
        // Remove the opening /** and closing */
        $lines = explode("\n", $docBlock);

        if (count($lines) <= 1) {
            return null; // Already single line or invalid
        }

        $contentLines = [];

        foreach ($lines as $line) {
            $trimmedLine = trim($line);
            // Skip opening /** and closing */
            if ($trimmedLine === "/**") {
                continue;
            }
            if ($trimmedLine === "*/") {
                continue;
            }

            // Remove leading * and whitespace
            $trimmedLine = preg_replace('/^\*\s?/', "", $trimmedLine);

            if ($trimmedLine !== "") {
                $contentLines[] = $trimmedLine;
            }
        }

        // Don't collapse if there are multiple content lines (e.g., description + tags)
        // or if there are no content lines
        if (count($contentLines) !== 1) {
            return null;
        }

        // Create single-line docblock
        return "/** " . $contentLines[0] . " */";
    }
}