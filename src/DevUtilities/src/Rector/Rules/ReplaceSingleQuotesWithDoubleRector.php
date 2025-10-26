<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\DevUtilities\Rector\Rules;

use PhpParser\Node;
use PhpParser\Node\Scalar\String_;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class ReplaceSingleQuotesWithDoubleRector extends AbstractRector
{
    private const EXCLUDED_SYMBOLS = ['$', "'", '\\', "\n", "\r", "\t", "\v", "\e", "\f", "\0", "\x"];

    public function getNodeTypes(): array
    {
        return [String_::class];
    }

    /** @param String_ $node */
    public function refactor(Node $node): ?Node
    {
        if ($node->getAttribute("kind") === String_::KIND_SINGLE_QUOTED) {
            // Get the text of the string literal
            $stringValue = $node->value;

            // Check if it does not contain variables
            if ($this->notContainExcludedSymbol($stringValue)) {
                // Replace double quotes with single quotes
                return new String_($stringValue, ["kind" => String_::KIND_DOUBLE_QUOTED]);
            }

            return null;
        }

        return null;
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition("Replace double quotes with single quotes", [
            new CodeSample(
                <<<'CODE_SAMPLE'
class SomeClass
{
    public function someMethod()
    {
        return 'Some string';
    }
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
class SomeClass
{
    public function someMethod()
    {
        return "Some string";
    }
}
CODE_SAMPLE
            ),
        ]);
    }

    private function notContainExcludedSymbol(string $symbol): bool
    {
        foreach (self::EXCLUDED_SYMBOLS as $excludedSymbol) {
            if (str_contains($symbol, $excludedSymbol)) {
                return false;
            }
        }

        return true;
    }
}