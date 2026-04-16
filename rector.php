<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\FuncCall\SingleInArrayToCompareRector;
use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\CodingStyle\Rector\PostInc\PostIncDecToPreIncDecRector;
use Rector\CodingStyle\Rector\Stmt\NewlineAfterStatementRector;
use Rector\Config\RectorConfig;
use Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector;
use Rector\PostRector\Rector\NameImportingPostRector;
use RectorLaravel\Rector\Class_\AddExtendsAnnotationToModelFactoriesRector;
use RectorLaravel\Rector\Class_\AnonymousMigrationsRector;
use RectorLaravel\Rector\Class_\ModelCastsPropertyToCastsMethodRector;
use RectorLaravel\Rector\Class_\ReplaceQueueTraitsWithQueueableRector;
use RectorLaravel\Rector\ClassMethod\AddGenericReturnTypeToRelationsRector;
use RectorLaravel\Rector\Empty_\EmptyToBlankAndFilledFuncRector;
use RectorLaravel\Rector\Expr\AppEnvironmentComparisonToParameterRector;
use RectorLaravel\Rector\Expr\SubStrToStartsWithOrEndsWithStaticMethodCallRector\SubStrToStartsWithOrEndsWithStaticMethodCallRector;
use RectorLaravel\Rector\FuncCall\ConfigToTypedConfigMethodCallRector;
use RectorLaravel\Rector\FuncCall\NotFilledBlankFuncCallToBlankFilledFuncCallRector;
use RectorLaravel\Rector\FuncCall\NowFuncWithStartOfDayMethodCallToTodayFuncRector;
use RectorLaravel\Rector\FuncCall\RemoveDumpDataDeadCodeRector;
use RectorLaravel\Rector\FuncCall\ThrowIfAndThrowUnlessExceptionsToUseClassStringRector;
use RectorLaravel\Rector\If_\AbortIfRector;
use RectorLaravel\Rector\If_\ThrowIfRector;
use RectorLaravel\Rector\MethodCall\AssertStatusToAssertMethodRector;
use RectorLaravel\Rector\MethodCall\EloquentWhereRelationTypeHintingParameterRector;
use RectorLaravel\Rector\MethodCall\EloquentWhereTypeHintClosureParameterRector;
use RectorLaravel\Rector\MethodCall\ReverseConditionableMethodCallRector;
use RectorLaravel\Rector\MethodCall\ValidationRuleArrayStringValueToArrayRector;
use RectorLaravel\Rector\StaticCall\AssertWithClassStringToTypeHintedClosureRector;
use RectorLaravel\Rector\StaticCall\EloquentMagicMethodToQueryBuilderRector;
use RectorLaravel\Set\LaravelSetProvider;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/../../../app',
        __DIR__.'/../../../config',
        __DIR__.'/../../../database',
        __DIR__.'/../../../routes',
        __DIR__.'/../../../resources',
        __DIR__.'/../../../tests',
    ])
    ->withSetProviders(LaravelSetProvider::class)
    ->withPhpSets()
    ->withImportNames(removeUnusedImports: true)
    ->withFluentCallNewLine()
    ->withRules([
        // Laravel
        AbortIfRector::class, // Change if abort to abort_if
        AddExtendsAnnotationToModelFactoriesRector::class, // Adds the @extends annotation to Factories.
        AddGenericReturnTypeToRelationsRector::class, // Add generic return type to relations in child of Illuminate\Database\Eloquent\Model
        AnonymousMigrationsRector::class, // Convert migrations to anonymous classes.
        AppEnvironmentComparisonToParameterRector::class, // Replace app environment comparison with parameter or method call
        AssertStatusToAssertMethodRector::class, // Replace assertStatus(200) with assertOk() and similar named methods
        AssertWithClassStringToTypeHintedClosureRector::class, // Changes assert calls to use a type hinted closure.
        ConfigToTypedConfigMethodCallRector::class, // Refactor config() calls to use type-specific methods when the expected type is known
        EloquentMagicMethodToQueryBuilderRector::class, // Transform magic method calls on Eloquent Models into corresponding Query Builder method calls.
        EloquentWhereRelationTypeHintingParameterRector::class, // Add type hinting to where relation methods e.g. whereHas, orWhereHas, whereDoesntHave, etc.
        EloquentWhereTypeHintClosureParameterRector::class, // Change typehint of closure parameter in where method of Eloquent or Query Builder
        EmptyToBlankAndFilledFuncRector::class, // Replace use of the unsafe empty() function with Laravel's safer blank() & filled() functions.
        ModelCastsPropertyToCastsMethodRector::class, // Refactor Model $casts property with casts() method
        NotFilledBlankFuncCallToBlankFilledFuncCallRector::class, // Swap the use of NotBooleans used with filled() and blank() to the correct helper.
        NowFuncWithStartOfDayMethodCallToTodayFuncRector::class, // Use today() instead of now()->startOfDay()
        RemoveDumpDataDeadCodeRector::class, // Remove dump data dead code like dd() or dump() calls.
        ReplaceQueueTraitsWithQueueableRector::class, // Replace Dispatchable, InteractsWithQueue, Queueable, and SerializesModels traits with the Queueable trait
        ReverseConditionableMethodCallRector::class, // Reverse conditionable method calls
        SubStrToStartsWithOrEndsWithStaticMethodCallRector::class, // Use Str::startsWith() or Str::endsWith() instead of substr() === $str
        ThrowIfAndThrowUnlessExceptionsToUseClassStringRector::class, // Changes use of a new throw instance to class string
        ThrowIfRector::class, // Change if throw to throw_if
        ValidationRuleArrayStringValueToArrayRector::class, // Convert string validation rules into arrays for Laravel's Validator.
    ])
    ->withSkip([
        PostIncDecToPreIncDecRector::class, // Skip turning $i++ into ++$i, this conflicts with Pint
        ClosureToArrowFunctionRector::class, // Skip turning all anonymous functions into arrow functions.
        EncapsedStringsToSprintfRector::class, // Skip turning "abc {$var}" into sprintf('abc %s', $var).
        NewlineAfterStatementRector::class, // Don't add new lines, this is phpcs' responsibility
        SingleInArrayToCompareRector::class, // Skip turning in_array checks into `===` checks
        NameImportingPostRector::class => [ // Skip importing names in config files.
            'config',
        ],
    ]);
