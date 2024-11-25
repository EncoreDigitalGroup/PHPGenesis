<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\DevUtilities\Rector;

use PHPGenesis\Common\Resources\Rector\ReplaceSingleQuotesWithDoubleRector;
use Rector\CodeQuality\Rector\Equal\UseIdenticalOverEqualWithSameTypeRector;
use Rector\CodeQuality\Rector\FuncCall\CompactToVariablesRector;
use Rector\CodeQuality\Rector\LogicalAnd\LogicalToBooleanRector;
use Rector\CodingStyle\Rector\Catch_\CatchExceptionNameMatchingTypeRector;
use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\CodingStyle\Rector\Stmt\NewlineAfterStatementRector;
use Rector\CodingStyle\Rector\Use_\SeparateMultiUseImportsRector;
use Rector\Naming\Rector\Assign\RenameVariableToMatchMethodCallReturnTypeRector;
use Rector\Naming\Rector\ClassMethod\RenameParamToMatchTypeRector;
use Rector\Naming\Rector\Foreach_\RenameForeachValueVariableToMatchExprVariableRector;
use Rector\Php71\Rector\FuncCall\RemoveExtraParametersRector;
use Rector\Strict\Rector\BooleanNot\BooleanInBooleanNotRuleFixerRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;

class Rector
{
    public static function rules(array $rules): array
    {
        return array_merge([
            AddVoidReturnTypeWhereNoReturnRector::class,
            ReplaceSingleQuotesWithDoubleRector::class,
        ], $rules);
    }

    public static function skip(array $rules): array
    {
        return array_merge([
            CompactToVariablesRector::class,
            UseIdenticalOverEqualWithSameTypeRector::class,
            LogicalToBooleanRector::class,
            CatchExceptionNameMatchingTypeRector::class,
            EncapsedStringsToSprintfRector::class,
            RenameForeachValueVariableToMatchExprVariableRector::class,
            RenameParamToMatchTypeRector::class,
            RenameVariableToMatchMethodCallReturnTypeRector::class,
            SeparateMultiUseImportsRector::class,
            RemoveExtraParametersRector::class,
            NewlineAfterStatementRector::class,
            BooleanInBooleanNotRuleFixerRector::class,
        ], $rules);
    }
}