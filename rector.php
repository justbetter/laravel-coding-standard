<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\FuncCall\SingleInArrayToCompareRector;
use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\CodingStyle\Rector\Stmt\NewlineAfterStatementRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\MethodCall\RemoveNullArgOnNullDefaultParamRector;
use Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector;
use Rector\PostRector\Rector\NameImportingPostRector;
use RectorLaravel\Rector\Class_\AppendsPropertyToAppendsAttributeRector;
use RectorLaravel\Rector\Class_\BackoffPropertyToBackoffAttributeRector;
use RectorLaravel\Rector\Class_\ConnectionPropertyToConnectionAttributeRector;
use RectorLaravel\Rector\Class_\FailOnTimeoutPropertyToFailOnTimeoutAttributeRector;
use RectorLaravel\Rector\Class_\FillablePropertyToFillableAttributeRector;
use RectorLaravel\Rector\Class_\GuardedPropertyToGuardedAttributeRector;
use RectorLaravel\Rector\Class_\HiddenPropertyToHiddenAttributeRector;
use RectorLaravel\Rector\Class_\JobConnectionPropertyToJobConnectionAttributeRector;
use RectorLaravel\Rector\Class_\MaxExceptionsPropertyToMaxExceptionsAttributeRector;
use RectorLaravel\Rector\Class_\ModelCastsPropertyToCastsMethodRector;
use RectorLaravel\Rector\Class_\QueuePropertyToQueueAttributeRector;
use RectorLaravel\Rector\Class_\TablePropertyToTableAttributeRector;
use RectorLaravel\Rector\Class_\TimeoutPropertyToTimeoutAttributeRector;
use RectorLaravel\Rector\Class_\TouchesPropertyToTouchesAttributeRector;
use RectorLaravel\Rector\Class_\TriesPropertyToTriesAttributeRector;
use RectorLaravel\Rector\Class_\UniqueForPropertyToUniqueForAttributeRector;
use RectorLaravel\Rector\FuncCall\AppToResolveRector;
use RectorLaravel\Rector\MethodCall\RedirectRouteToToRouteHelperRector;
use RectorLaravel\Rector\StaticCall\DispatchToHelperFunctionsRector;
use RectorLaravel\Set\LaravelSetList;
use RectorLaravel\Set\LaravelSetProvider;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/../../../app',
        __DIR__ . '/../../../config',
        __DIR__ . '/../../../routes',
        __DIR__ . '/../../../resources',
        __DIR__ . '/../../../tests',
    ])
    ->withSetProviders(LaravelSetProvider::class)
    ->withComposerBased(laravel: true)
    ->withPhpSets()
    ->withImportNames(removeUnusedImports: true)
    ->withFluentCallNewLine()
    ->withSets([
        // https://github.com/driftingly/rector-laravel#additional-sets
        LaravelSetList::LARAVEL_CODE_QUALITY, // https://getrector.com/find-rule?activeRectorSetGroup=laravel&rectorSet=laravel-code-quality
        LaravelSetList::LARAVEL_COLLECTION, // https://getrector.com/find-rule?activeRectorSetGroup=laravel&rectorSet=laravel-collection-improvements-and-simplifications
        LaravelSetList::LARAVEL_ELOQUENT_MAGIC_METHOD_TO_QUERY_BUILDER, // https://getrector.com/find-rule?activeRectorSetGroup=laravel&rectorSet=laravel-replace-magic-methods-with-query-builder
        LaravelSetList::LARAVEL_IF_HELPERS, // https://getrector.com/find-rule?activeRectorSetGroup=laravel&rectorSet=laravel-replace-if-statements-with-helpers
        LaravelSetList::LARAVEL_TYPE_DECLARATIONS, // https://github.com/driftingly/rector-laravel/blob/main/config/sets/laravel-type-declarations.php
    ])
    ->withSkip([
        ClosureToArrowFunctionRector::class, // Skip turning all anonymous functions into arrow functions.
        EncapsedStringsToSprintfRector::class, // Skip turning "abc {$var}" into sprintf('abc %s', $var).
        ModelCastsPropertyToCastsMethodRector::class, // Skip turning casts variable to function.
        NewlineAfterStatementRector::class, // Don't add new lines, this is phpcs' responsibility
        RemoveNullArgOnNullDefaultParamRector::class, // Skip removing null from instances like `where('x', '=', null)`
        DispatchToHelperFunctionsRector::class, // Skip turning Job::dispatch() into dispatch(new Job())
        AppToResolveRector::class, // Skip turning app(Resolvable::class) into resolve(Resolvable::class)
        RedirectRouteToToRouteHelperRector::class, // Skip turing redirect()->route(...) into `to_route`
        SingleInArrayToCompareRector::class, // Skip turning in_array checks into `===` checks
        NameImportingPostRector::class => [ // Skip importing names in config files.
            'config'
        ],
    ])
    // Laravel 13
    ->withSkip([
        // Skip turning all properties into attributes
        AppendsPropertyToAppendsAttributeRector::class,
        BackoffPropertyToBackoffAttributeRector::class,
        ConnectionPropertyToConnectionAttributeRector::class,
        FailOnTimeoutPropertyToFailOnTimeoutAttributeRector::class,
        FillablePropertyToFillableAttributeRector::class,
        GuardedPropertyToGuardedAttributeRector::class,
        HiddenPropertyToHiddenAttributeRector::class,
        JobConnectionPropertyToJobConnectionAttributeRector::class,
        MaxExceptionsPropertyToMaxExceptionsAttributeRector::class,
        QueuePropertyToQueueAttributeRector::class,
        TablePropertyToTableAttributeRector::class,
        TimeoutPropertyToTimeoutAttributeRector::class,
        TouchesPropertyToTouchesAttributeRector::class,
        TriesPropertyToTriesAttributeRector::class,
        UniqueForPropertyToUniqueForAttributeRector::class,
    ]);
