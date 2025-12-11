<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\DevUtilities\Rector;

use PHPGenesis\DevUtilities\Rector\Rules\ApplySingleItemDocBlockStyleRector;
use PHPGenesis\DevUtilities\Rector\Rules\ExpandSeeAnnotationClassNameRector;
use PHPGenesis\DevUtilities\Rector\Rules\ReplaceSingleQuotesWithDoubleRector;
use Rector\CodeQuality\Rector\Assign\CombinedAssignRector;
use Rector\CodeQuality\Rector\BooleanAnd\RemoveUselessIsObjectCheckRector;
use Rector\CodeQuality\Rector\BooleanAnd\SimplifyEmptyArrayCheckRector;
use Rector\CodeQuality\Rector\BooleanNot\ReplaceMultipleBooleanNotRector;
use Rector\CodeQuality\Rector\BooleanNot\SimplifyDeMorganBinaryRector;
use Rector\CodeQuality\Rector\Catch_\ThrowWithPreviousExceptionRector;
use Rector\CodeQuality\Rector\Class_\CompleteDynamicPropertiesRector;
use Rector\CodeQuality\Rector\Class_\ConvertStaticToSelfRector;
use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\CodeQuality\Rector\ClassMethod\ExplicitReturnNullRector;
use Rector\CodeQuality\Rector\ClassMethod\InlineArrayReturnAssignRector;
use Rector\CodeQuality\Rector\ClassMethod\LocallyCalledStaticMethodToNonStaticRector;
use Rector\CodeQuality\Rector\ClassMethod\OptionalParametersAfterRequiredRector;
use Rector\CodeQuality\Rector\Concat\JoinStringConcatRector;
use Rector\CodeQuality\Rector\Empty_\SimplifyEmptyCheckOnEmptyArrayRector;
use Rector\CodeQuality\Rector\Equal\UseIdenticalOverEqualWithSameTypeRector;
use Rector\CodeQuality\Rector\Expression\InlineIfToExplicitIfRector;
use Rector\CodeQuality\Rector\Expression\TernaryFalseExpressionToIfRector;
use Rector\CodeQuality\Rector\For_\ForRepeatedCountToOwnVariableRector;
use Rector\CodeQuality\Rector\Foreach_\ForeachItemsAssignToEmptyArrayToAssignRector;
use Rector\CodeQuality\Rector\Foreach_\ForeachToInArrayRector;
use Rector\CodeQuality\Rector\Foreach_\SimplifyForeachToCoalescingRector;
use Rector\CodeQuality\Rector\Foreach_\UnusedForeachValueToArrayKeysRector;
use Rector\CodeQuality\Rector\FuncCall\ArrayMergeOfNonArraysToSimpleArrayRector;
use Rector\CodeQuality\Rector\FuncCall\CallUserFuncWithArrowFunctionToInlineRector;
use Rector\CodeQuality\Rector\FuncCall\ChangeArrayPushToArrayAssignRector;
use Rector\CodeQuality\Rector\FuncCall\CompactToVariablesRector;
use Rector\CodeQuality\Rector\FuncCall\InlineIsAInstanceOfRector;
use Rector\CodeQuality\Rector\FuncCall\IsAWithStringWithThirdArgumentRector;
use Rector\CodeQuality\Rector\FuncCall\RemoveSoleValueSprintfRector;
use Rector\CodeQuality\Rector\FuncCall\SetTypeToCastRector;
use Rector\CodeQuality\Rector\FuncCall\SimplifyFuncGetArgsCountRector;
use Rector\CodeQuality\Rector\FuncCall\SimplifyInArrayValuesRector;
use Rector\CodeQuality\Rector\FuncCall\SimplifyRegexPatternRector;
use Rector\CodeQuality\Rector\FuncCall\SimplifyStrposLowerRector;
use Rector\CodeQuality\Rector\FuncCall\SingleInArrayToCompareRector;
use Rector\CodeQuality\Rector\FuncCall\UnwrapSprintfOneArgumentRector;
use Rector\CodeQuality\Rector\FunctionLike\SimplifyUselessVariableRector;
use Rector\CodeQuality\Rector\Identical\BooleanNotIdenticalToNotIdenticalRector;
use Rector\CodeQuality\Rector\Identical\FlipTypeControlToUseExclusiveTypeRector;
use Rector\CodeQuality\Rector\Identical\SimplifyArraySearchRector;
use Rector\CodeQuality\Rector\Identical\SimplifyBoolIdenticalTrueRector;
use Rector\CodeQuality\Rector\Identical\SimplifyConditionsRector;
use Rector\CodeQuality\Rector\Identical\StrlenZeroToIdenticalEmptyStringRector;
use Rector\CodeQuality\Rector\If_\CombineIfRector;
use Rector\CodeQuality\Rector\If_\CompleteMissingIfElseBracketRector;
use Rector\CodeQuality\Rector\If_\ConsecutiveNullCompareReturnsToNullCoalesceQueueRector;
use Rector\CodeQuality\Rector\If_\ExplicitBoolCompareRector;
use Rector\CodeQuality\Rector\If_\ShortenElseIfRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfElseToTernaryRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfNotNullReturnRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfNullableReturnRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfReturnBoolRector;
use Rector\CodeQuality\Rector\Include_\AbsolutizeRequireAndIncludePathRector;
use Rector\CodeQuality\Rector\Isset_\IssetOnPropertyObjectToPropertyExistsRector;
use Rector\CodeQuality\Rector\LogicalAnd\AndAssignsToSeparateLinesRector;
use Rector\CodeQuality\Rector\LogicalAnd\LogicalToBooleanRector;
use Rector\CodeQuality\Rector\New_\NewStaticToNewSelfRector;
use Rector\CodeQuality\Rector\NotEqual\CommonNotEqualRector;
use Rector\CodeQuality\Rector\NullsafeMethodCall\CleanupUnneededNullsafeOperatorRector;
use Rector\CodeQuality\Rector\Switch_\SingularSwitchToIfRector;
use Rector\CodeQuality\Rector\Switch_\SwitchTrueToIfRector;
use Rector\CodeQuality\Rector\Ternary\ArrayKeyExistsTernaryThenValueToCoalescingRector;
use Rector\CodeQuality\Rector\Ternary\NumberCompareToMaxFuncCallRector;
use Rector\CodeQuality\Rector\Ternary\SimplifyTautologyTernaryRector;
use Rector\CodeQuality\Rector\Ternary\SwitchNegatedTernaryRector;
use Rector\CodeQuality\Rector\Ternary\TernaryEmptyArrayArrayDimFetchToCoalesceRector;
use Rector\CodeQuality\Rector\Ternary\UnnecessaryTernaryExpressionRector;
use Rector\CodingStyle\Rector\Assign\SplitDoubleAssignRector;
use Rector\CodingStyle\Rector\Catch_\CatchExceptionNameMatchingTypeRector;
use Rector\CodingStyle\Rector\ClassConst\RemoveFinalFromConstRector;
use Rector\CodingStyle\Rector\ClassConst\SplitGroupedClassConstantsRector;
use Rector\CodingStyle\Rector\ClassMethod\FuncGetArgsToVariadicParamRector;
use Rector\CodingStyle\Rector\ClassMethod\MakeInheritedMethodVisibilitySameAsParentRector;
use Rector\CodingStyle\Rector\ClassMethod\NewlineBeforeNewAssignSetRector;
use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\CodingStyle\Rector\Encapsed\WrapEncapsedVariableInCurlyBracesRector;
use Rector\CodingStyle\Rector\FuncCall\CallUserFuncArrayToVariadicRector;
use Rector\CodingStyle\Rector\FuncCall\CallUserFuncToMethodCallRector;
use Rector\CodingStyle\Rector\FuncCall\ConsistentImplodeRector;
use Rector\CodingStyle\Rector\FuncCall\CountArrayToEmptyArrayComparisonRector;
use Rector\CodingStyle\Rector\FuncCall\StrictArraySearchRector;
use Rector\CodingStyle\Rector\FuncCall\VersionCompareFuncCallToConstantRector;
use Rector\CodingStyle\Rector\If_\NullableCompareToNullRector;
use Rector\CodingStyle\Rector\Property\SplitGroupedPropertiesRector;
use Rector\CodingStyle\Rector\Stmt\NewlineAfterStatementRector;
use Rector\CodingStyle\Rector\Stmt\RemoveUselessAliasInUseStatementRector;
use Rector\CodingStyle\Rector\String_\UseClassKeywordForClassNameResolutionRector;
use Rector\CodingStyle\Rector\Ternary\TernaryConditionVariableAssignmentRector;
use Rector\CodingStyle\Rector\Use_\SeparateMultiUseImportsRector;
use Rector\Config\RectorConfig;
use Rector\Configuration\RectorConfigBuilder;
use Rector\DeadCode\Rector\Array_\RemoveDuplicatedArrayKeyRector;
use Rector\DeadCode\Rector\Assign\RemoveDoubleAssignRector;
use Rector\DeadCode\Rector\Assign\RemoveUnusedVariableAssignRector;
use Rector\DeadCode\Rector\BooleanAnd\RemoveAndTrueRector;
use Rector\DeadCode\Rector\Cast\RecastingRemovalRector;
use Rector\DeadCode\Rector\ClassConst\RemoveUnusedPrivateClassConstantRector;
use Rector\DeadCode\Rector\ClassLike\RemoveTypedPropertyNonMockDocblockRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveEmptyClassMethodRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveNullTagValueNodeRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedConstructorParamRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPrivateMethodParameterRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPrivateMethodRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPromotedPropertyRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPublicMethodParameterRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessParamTagRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessReturnExprInConstructRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessReturnTagRector;
use Rector\DeadCode\Rector\Concat\RemoveConcatAutocastRector;
use Rector\DeadCode\Rector\ConstFetch\RemovePhpVersionIdCheckRector;
use Rector\DeadCode\Rector\Expression\RemoveDeadStmtRector;
use Rector\DeadCode\Rector\Expression\SimplifyMirrorAssignRector;
use Rector\DeadCode\Rector\For_\RemoveDeadContinueRector;
use Rector\DeadCode\Rector\For_\RemoveDeadIfForeachForRector;
use Rector\DeadCode\Rector\For_\RemoveDeadLoopRector;
use Rector\DeadCode\Rector\Foreach_\RemoveUnusedForeachKeyRector;
use Rector\DeadCode\Rector\FunctionLike\RemoveDeadReturnRector;
use Rector\DeadCode\Rector\If_\ReduceAlwaysFalseIfOrRector;
use Rector\DeadCode\Rector\If_\RemoveAlwaysTrueIfConditionRector;
use Rector\DeadCode\Rector\If_\RemoveDeadInstanceOfRector;
use Rector\DeadCode\Rector\If_\RemoveTypedPropertyDeadInstanceOfRector;
use Rector\DeadCode\Rector\If_\RemoveUnusedNonEmptyArrayBeforeForeachRector;
use Rector\DeadCode\Rector\If_\SimplifyIfElseWithSameContentRector;
use Rector\DeadCode\Rector\If_\UnwrapFutureCompatibleIfPhpVersionRector;
use Rector\DeadCode\Rector\Node\RemoveNonExistingVarAnnotationRector;
use Rector\DeadCode\Rector\Plus\RemoveDeadZeroAndOneOperationRector;
use Rector\DeadCode\Rector\Property\RemoveUnusedPrivatePropertyRector;
use Rector\DeadCode\Rector\Property\RemoveUselessReadOnlyTagRector;
use Rector\DeadCode\Rector\Property\RemoveUselessVarTagRector;
use Rector\DeadCode\Rector\PropertyProperty\RemoveNullPropertyInitializationRector;
use Rector\DeadCode\Rector\Return_\RemoveDeadConditionAboveReturnRector;
use Rector\DeadCode\Rector\StaticCall\RemoveParentCallWithoutParentRector;
use Rector\DeadCode\Rector\Stmt\RemoveUnreachableStatementRector;
use Rector\DeadCode\Rector\Switch_\RemoveDuplicatedCaseInSwitchRector;
use Rector\DeadCode\Rector\Ternary\TernaryToBooleanOrFalseToBooleanAndRector;
use Rector\DeadCode\Rector\TryCatch\RemoveDeadTryCatchRector;
use Rector\EarlyReturn\Rector\Foreach_\ChangeNestedForeachIfsToEarlyContinueRector;
use Rector\EarlyReturn\Rector\If_\ChangeIfElseValueAssignToEarlyReturnRector;
use Rector\EarlyReturn\Rector\If_\ChangeNestedIfsToEarlyReturnRector;
use Rector\EarlyReturn\Rector\If_\ChangeOrIfContinueToMultiContinueRector;
use Rector\EarlyReturn\Rector\If_\RemoveAlwaysElseRector;
use Rector\EarlyReturn\Rector\Return_\PreparedValueToEarlyReturnRector;
use Rector\EarlyReturn\Rector\Return_\ReturnBinaryOrToEarlyReturnRector;
use Rector\EarlyReturn\Rector\StmtsAwareInterface\ReturnEarlyIfVariableRector;
use Rector\Instanceof_\Rector\Ternary\FlipNegatedTernaryInstanceofRector;
use Rector\Naming\Rector\Assign\RenameVariableToMatchMethodCallReturnTypeRector;
use Rector\Naming\Rector\Foreach_\RenameForeachValueVariableToMatchExprVariableRector;
use Rector\Naming\Rector\Foreach_\RenameForeachValueVariableToMatchMethodCallReturnTypeRector;
use Rector\Php52\Rector\Property\VarToPublicPropertyRector;
use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;
use Rector\Php71\Rector\FuncCall\RemoveExtraParametersRector;
use Rector\Privatization\Rector\ClassMethod\PrivatizeFinalClassMethodRector;
use Rector\Privatization\Rector\MethodCall\PrivatizeLocalGetterToPropertyRector;
use Rector\Privatization\Rector\Property\PrivatizeFinalClassPropertyRector;
use Rector\Renaming\Rector\FuncCall\RenameFunctionRector;
use Rector\Symfony\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector;
use Rector\Transform\Rector\FuncCall\FuncCallToConstFetchRector;
use Rector\TypeDeclaration\Rector\ArrowFunction\AddArrowFunctionReturnTypeRector;
use Rector\TypeDeclaration\Rector\BooleanAnd\BinaryOpNullableToInstanceofRector;
use Rector\TypeDeclaration\Rector\Class_\AddTestsVoidReturnTypeWhereNoReturnRector;
use Rector\TypeDeclaration\Rector\Class_\ChildDoctrineRepositoryClassTypeRector;
use Rector\TypeDeclaration\Rector\Class_\MergeDateTimePropertyTypeDeclarationRector;
use Rector\TypeDeclaration\Rector\Class_\PropertyTypeFromStrictSetterGetterRector;
use Rector\TypeDeclaration\Rector\Class_\ReturnTypeFromStrictTernaryRector;
use Rector\TypeDeclaration\Rector\Class_\TypedPropertyFromCreateMockAssignRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddMethodCallBasedStrictParamTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeBasedOnPHPUnitDataProviderRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeFromPropertyTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeDeclarationBasedOnParentClassMethodRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;
use Rector\TypeDeclaration\Rector\ClassMethod\BoolReturnTypeFromBooleanConstReturnsRector;
use Rector\TypeDeclaration\Rector\ClassMethod\BoolReturnTypeFromBooleanStrictReturnsRector;
use Rector\TypeDeclaration\Rector\ClassMethod\NumericReturnTypeFromStrictReturnsRector;
use Rector\TypeDeclaration\Rector\ClassMethod\NumericReturnTypeFromStrictScalarReturnsRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByMethodCallTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByParentCallTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnNeverTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnNullableTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromMockObjectRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromReturnCastRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromReturnDirectArrayRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromReturnNewRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictConstantReturnRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictFluentReturnRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNativeCallRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNewArrayRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictParamRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictTypedCallRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictTypedPropertyRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromSymfonySerializerRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnUnionTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\StrictArrayParamDimFetchRector;
use Rector\TypeDeclaration\Rector\ClassMethod\StrictStringParamConcatRector;
use Rector\TypeDeclaration\Rector\ClassMethod\StringReturnTypeFromStrictScalarReturnsRector;
use Rector\TypeDeclaration\Rector\ClassMethod\StringReturnTypeFromStrictStringReturnsRector;
use Rector\TypeDeclaration\Rector\Closure\AddClosureNeverReturnTypeRector;
use Rector\TypeDeclaration\Rector\Closure\AddClosureVoidReturnTypeWhereNoReturnRector;
use Rector\TypeDeclaration\Rector\Closure\ClosureReturnTypeRector;
use Rector\TypeDeclaration\Rector\Empty_\EmptyOnNullableObjectToInstanceOfRector;
use Rector\TypeDeclaration\Rector\Function_\AddFunctionVoidReturnTypeWhereNoReturnRector;
use Rector\TypeDeclaration\Rector\FunctionLike\AddParamTypeSplFixedArrayRector;
use Rector\TypeDeclaration\Rector\FunctionLike\AddReturnTypeDeclarationFromYieldsRector;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromAssignsRector;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictConstructorRector;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictSetUpRector;
use Rector\TypeDeclaration\Rector\While_\WhileNullableToInstanceofRector;
use Rector\Visibility\Rector\ClassMethod\ExplicitPublicClassMethodRector;

class Rector
{
    public static function configure(): RectorConfigBuilder
    {
        return RectorConfig::configure()
            ->withRules(Rector::rules())
            ->withImportNames()
            ->withParallel(600);
    }

    public static function rules(array $rules = [], array $except = []): array
    {
        $allRules = array_merge([
            AddVoidReturnTypeWhereNoReturnRector::class,
            ReplaceSingleQuotesWithDoubleRector::class,
            ApplySingleItemDocBlockStyleRector::class,
            ExpandSeeAnnotationClassNameRector::class,
            CombinedAssignRector::class,
            RemoveUselessIsObjectCheckRector::class,
            SimplifyEmptyArrayCheckRector::class,
            ReplaceMultipleBooleanNotRector::class,
            SimplifyDeMorganBinaryRector::class,
            ThrowWithPreviousExceptionRector::class,
            ConvertStaticToSelfRector::class,
            ExplicitReturnNullRector::class,
            InlineArrayReturnAssignRector::class,
            LocallyCalledStaticMethodToNonStaticRector::class,
            OptionalParametersAfterRequiredRector::class,
            CompleteDynamicPropertiesRector::class,
            InlineConstructorDefaultToPropertyRector::class,
            JoinStringConcatRector::class,
            SimplifyEmptyCheckOnEmptyArrayRector::class,
            InlineIfToExplicitIfRector::class,
            TernaryFalseExpressionToIfRector::class,
            ForRepeatedCountToOwnVariableRector::class,
            ForeachItemsAssignToEmptyArrayToAssignRector::class,
            ForeachToInArrayRector::class,
            SimplifyForeachToCoalescingRector::class,
            UnusedForeachValueToArrayKeysRector::class,
            ArrayMergeOfNonArraysToSimpleArrayRector::class,
            CallUserFuncWithArrowFunctionToInlineRector::class,
            ChangeArrayPushToArrayAssignRector::class,
            InlineIsAInstanceOfRector::class,
            IsAWithStringWithThirdArgumentRector::class,
            RemoveSoleValueSprintfRector::class,
            SetTypeToCastRector::class,
            SimplifyFuncGetArgsCountRector::class,
            SimplifyInArrayValuesRector::class,
            SimplifyRegexPatternRector::class,
            SimplifyStrposLowerRector::class,
            SingleInArrayToCompareRector::class,
            UnwrapSprintfOneArgumentRector::class,
            SimplifyUselessVariableRector::class,
            BooleanNotIdenticalToNotIdenticalRector::class,
            FlipTypeControlToUseExclusiveTypeRector::class,
            SimplifyArraySearchRector::class,
            SimplifyBoolIdenticalTrueRector::class,
            SimplifyConditionsRector::class,
            StrlenZeroToIdenticalEmptyStringRector::class,
            CombineIfRector::class,
            CompleteMissingIfElseBracketRector::class,
            ConsecutiveNullCompareReturnsToNullCoalesceQueueRector::class,
            ExplicitBoolCompareRector::class,
            ShortenElseIfRector::class,
            SimplifyIfElseToTernaryRector::class,
            SimplifyIfNotNullReturnRector::class,
            SimplifyIfNullableReturnRector::class,
            SimplifyIfReturnBoolRector::class,
            AbsolutizeRequireAndIncludePathRector::class,
            IssetOnPropertyObjectToPropertyExistsRector::class,
            AndAssignsToSeparateLinesRector::class,
            NewStaticToNewSelfRector::class,
            CommonNotEqualRector::class,
            CleanupUnneededNullsafeOperatorRector::class,
            SingularSwitchToIfRector::class,
            SwitchTrueToIfRector::class,
            ArrayKeyExistsTernaryThenValueToCoalescingRector::class,
            NumberCompareToMaxFuncCallRector::class,
            SimplifyTautologyTernaryRector::class,
            SwitchNegatedTernaryRector::class,
            TernaryEmptyArrayArrayDimFetchToCoalesceRector::class,
            UnnecessaryTernaryExpressionRector::class,
            SplitDoubleAssignRector::class,
            RemoveFinalFromConstRector::class,
            SplitGroupedClassConstantsRector::class,
            FuncGetArgsToVariadicParamRector::class,
            MakeInheritedMethodVisibilitySameAsParentRector::class,
            NewlineBeforeNewAssignSetRector::class,
            WrapEncapsedVariableInCurlyBracesRector::class,
            CallUserFuncArrayToVariadicRector::class,
            CallUserFuncToMethodCallRector::class,
            ConsistentImplodeRector::class,
            CountArrayToEmptyArrayComparisonRector::class,
            StrictArraySearchRector::class,
            VersionCompareFuncCallToConstantRector::class,
            NullableCompareToNullRector::class,
            SplitGroupedPropertiesRector::class,
            RemoveUselessAliasInUseStatementRector::class,
            UseClassKeywordForClassNameResolutionRector::class,
            TernaryConditionVariableAssignmentRector::class,
            RemoveDuplicatedArrayKeyRector::class,
            RemoveDoubleAssignRector::class,
            RemoveUnusedVariableAssignRector::class,
            RemoveAndTrueRector::class,
            RecastingRemovalRector::class,
            RemoveUnusedPrivateClassConstantRector::class,
            RemoveTypedPropertyNonMockDocblockRector::class,
            RemoveEmptyClassMethodRector::class,
            RemoveNullTagValueNodeRector::class,
            RemoveUnusedConstructorParamRector::class,
            RemoveUnusedPrivateMethodParameterRector::class,
            RemoveUnusedPrivateMethodRector::class,
            RemoveUnusedPromotedPropertyRector::class,
            RemoveUnusedPublicMethodParameterRector::class,
            RemoveUselessParamTagRector::class,
            RemoveUselessReturnExprInConstructRector::class,
            RemoveUselessReturnTagRector::class,
            RemoveConcatAutocastRector::class,
            RemovePhpVersionIdCheckRector::class,
            RemoveDeadStmtRector::class,
            SimplifyMirrorAssignRector::class,
            RemoveDeadContinueRector::class,
            RemoveDeadIfForeachForRector::class,
            RemoveDeadLoopRector::class,
            RemoveUnusedForeachKeyRector::class,
            RemoveDeadReturnRector::class,
            ReduceAlwaysFalseIfOrRector::class,
            RemoveAlwaysTrueIfConditionRector::class,
            RemoveDeadInstanceOfRector::class,
            RemoveTypedPropertyDeadInstanceOfRector::class,
            RemoveUnusedNonEmptyArrayBeforeForeachRector::class,
            SimplifyIfElseWithSameContentRector::class,
            UnwrapFutureCompatibleIfPhpVersionRector::class,
            RemoveNonExistingVarAnnotationRector::class,
            RemoveDeadZeroAndOneOperationRector::class,
            RemoveNullPropertyInitializationRector::class,
            RemoveUnusedPrivatePropertyRector::class,
            RemoveUselessReadOnlyTagRector::class,
            RemoveUselessVarTagRector::class,
            RemoveDeadConditionAboveReturnRector::class,
            RemoveParentCallWithoutParentRector::class,
            RemoveUnreachableStatementRector::class,
            RemoveDuplicatedCaseInSwitchRector::class,
            TernaryToBooleanOrFalseToBooleanAndRector::class,
            RemoveDeadTryCatchRector::class,
            ChangeNestedForeachIfsToEarlyContinueRector::class,
            ChangeIfElseValueAssignToEarlyReturnRector::class,
            ChangeNestedIfsToEarlyReturnRector::class,
            ChangeOrIfContinueToMultiContinueRector::class,
            RemoveAlwaysElseRector::class,
            PreparedValueToEarlyReturnRector::class,
            ReturnBinaryOrToEarlyReturnRector::class,
            ReturnEarlyIfVariableRector::class,
            FlipNegatedTernaryInstanceofRector::class,
            RenameForeachValueVariableToMatchMethodCallReturnTypeRector::class,
            VarToPublicPropertyRector::class,
            StringClassNameToClassConstantRector::class,
            PrivatizeFinalClassMethodRector::class,
            PrivatizeLocalGetterToPropertyRector::class,
            PrivatizeFinalClassPropertyRector::class,
            RenameFunctionRector::class,
            ResponseReturnTypeControllerActionRector::class,
            FuncCallToConstFetchRector::class,
            AddArrowFunctionReturnTypeRector::class,
            BinaryOpNullableToInstanceofRector::class,
            AddMethodCallBasedStrictParamTypeRector::class,
            AddParamTypeBasedOnPHPUnitDataProviderRector::class,
            AddParamTypeFromPropertyTypeRector::class,
            AddReturnTypeDeclarationBasedOnParentClassMethodRector::class,
            BoolReturnTypeFromBooleanConstReturnsRector::class,
            BoolReturnTypeFromBooleanStrictReturnsRector::class,
            NumericReturnTypeFromStrictReturnsRector::class,
            NumericReturnTypeFromStrictScalarReturnsRector::class,
            ParamTypeByMethodCallTypeRector::class,
            ParamTypeByParentCallTypeRector::class,
            ReturnNeverTypeRector::class,
            ReturnNullableTypeRector::class,
            ReturnTypeFromMockObjectRector::class,
            ReturnTypeFromReturnCastRector::class,
            ReturnTypeFromReturnDirectArrayRector::class,
            ReturnTypeFromReturnNewRector::class,
            ReturnTypeFromStrictConstantReturnRector::class,
            ReturnTypeFromStrictFluentReturnRector::class,
            ReturnTypeFromStrictNativeCallRector::class,
            ReturnTypeFromStrictNewArrayRector::class,
            ReturnTypeFromStrictParamRector::class,
            ReturnTypeFromStrictTypedCallRector::class,
            ReturnTypeFromStrictTypedPropertyRector::class,
            ReturnTypeFromSymfonySerializerRector::class,
            ReturnUnionTypeRector::class,
            StrictArrayParamDimFetchRector::class,
            StrictStringParamConcatRector::class,
            StringReturnTypeFromStrictScalarReturnsRector::class,
            StringReturnTypeFromStrictStringReturnsRector::class,
            AddTestsVoidReturnTypeWhereNoReturnRector::class,
            ChildDoctrineRepositoryClassTypeRector::class,
            MergeDateTimePropertyTypeDeclarationRector::class,
            PropertyTypeFromStrictSetterGetterRector::class,
            ReturnTypeFromStrictTernaryRector::class,
            TypedPropertyFromCreateMockAssignRector::class,
            AddClosureNeverReturnTypeRector::class,
            AddClosureVoidReturnTypeWhereNoReturnRector::class,
            ClosureReturnTypeRector::class,
            EmptyOnNullableObjectToInstanceOfRector::class,
            AddParamTypeSplFixedArrayRector::class,
            AddReturnTypeDeclarationFromYieldsRector::class,
            AddFunctionVoidReturnTypeWhereNoReturnRector::class,
            TypedPropertyFromAssignsRector::class,
            TypedPropertyFromStrictConstructorRector::class,
            TypedPropertyFromStrictSetUpRector::class,
            WhileNullableToInstanceofRector::class,
            ExplicitPublicClassMethodRector::class,
        ], $rules);

        $filteredRules = array_diff($allRules, $except);

        return array_filter($filteredRules, fn (string $class): bool => class_exists($class));
    }

    public static function skip(array $rules = []): array
    {
        return array_merge([
            CompactToVariablesRector::class,
            UseIdenticalOverEqualWithSameTypeRector::class,
            LogicalToBooleanRector::class,
            CatchExceptionNameMatchingTypeRector::class,
            EncapsedStringsToSprintfRector::class,
            RenameForeachValueVariableToMatchExprVariableRector::class,
            RenameVariableToMatchMethodCallReturnTypeRector::class,
            SeparateMultiUseImportsRector::class,
            RemoveExtraParametersRector::class,
            NewlineAfterStatementRector::class,
        ], $rules);
    }
}