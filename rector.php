<?php

declare(strict_types=1);

use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\MethodCall\RemoveNullArgOnNullDefaultParamRector;
use Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector;
use Rector\PostRector\Rector\NameImportingPostRector;
use RectorLaravel\Rector\Class_\ModelCastsPropertyToCastsMethodRector;
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
        RemoveNullArgOnNullDefaultParamRector::class, // Skip removing null from instances like `where('x', '=', null)`
        DispatchToHelperFunctionsRector::class, // Skip turning Job::dispatch() into dispatch(new Job())
        AppToResolveRector::class, // Skip turning app(Resolvable::class) into resolve(Resolvable::class)
        RedirectRouteToToRouteHelperRector::class, // Skip turing redirect()->route(...) into `to_route`
        NameImportingPostRector::class => [ // Skip importing names in config files.
            'config'
        ]
    ]);
