<?php

declare(strict_types=1);

use Rector\Configuration\RectorConfigBuilder;

/** @var RectorConfigBuilder $rectorConfig */
$rectorConfig = require 'vendor/justbetter/laravel-coding-standard/rector.php';

$rectorConfig->withPaths([
    __DIR__ . '/app',
    __DIR__ . '/config',
    __DIR__ . '/routes',
    __DIR__ . '/resources',
    __DIR__ . '/tests',
    // __DIR__ . '/packages',
    // __DIR__ . '/modules',
]);

/** Define additional rules here
 * @see: https://getrector.com/find-rule?activeRectorSetGroup=laravel
 * @see: https://getrector.com/find-rule?activeRectorSetGroup=php
 * @see: https://getrector.com/find-rule?activeRectorSetGroup=core
 */
/** @see: https://getrector.com/documentation/levels */
$rectorConfig->withTypeCoverageDocblockLevel(0); // 1 is least intrusive changes, higher is more intrusive
$rectorConfig->withTypeCoverageLevel(0);         // 1 is least intrusive changes, higher is more intrusive
$rectorConfig->withCodeQualityLevel(0);          // 1 is least intrusive changes, higher is more intrusive
$rectorConfig->withCodingStyleLevel(0);          // 1 is least intrusive changes, higher is more intrusive
$rectorConfig->withDeadCodeLevel(0);             // 1 is least intrusive changes, higher is more intrusive

$rectorConfig->withPreparedSets(
    // Only enable these when the levels above are completed and their config is removed
    // It will automatically set their level to the highest possible.
    // typeDeclarationDocblocks: true, // https://getrector.com/find-rule?rectorSet=core-type-declarations&activeRectorSetGroup=core
    // typeDeclarations: true,     // https://getrector.com/find-rule?activeRectorSetGroup=core&rectorSet=core-type-declarations
    // codeQuality: true,          // https://getrector.com/find-rule?activeRectorSetGroup=core&rectorSet=core-code-quality
    // codingStyle: true,          // https://getrector.com/find-rule?activeRectorSetGroup=core&rectorSet=core-coding-style
    // deadCode: true,             // https://getrector.com/find-rule?activeRectorSetGroup=core&rectorSet=core-dead-code
    instanceOf: false,       // https://getrector.com/find-rule?rectorSet=core-instanceof&activeRectorSetGroup=core
    earlyReturn: false,      // https://getrector.com/find-rule?rectorSet=core-early-return&activeRectorSetGroup=core
);

return $rectorConfig;
