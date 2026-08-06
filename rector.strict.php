<?php

declare(strict_types=1);

use Rector\Configuration\RectorConfigBuilder;
use Rector\PHPUnit\CodeQuality\Rector\ClassMethod\ReplaceTestAnnotationWithPrefixedFunctionRector;

/** @var RectorConfigBuilder $rectorConfig */
$rectorConfig = require __DIR__ . '/rector.php';

return $rectorConfig
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        typeDeclarations: true,
        privatization: true,
        instanceOf: true,
        earlyReturn: true,
        carbon: true,
        phpunitCodeQuality: true,
    )->withSkip([
        ReplaceTestAnnotationWithPrefixedFunctionRector::class // prevent replacing @test with function testxxxx https://getrector.com/rule-detail/replace-test-annotation-with-prefixed-function-rector
    ]);
