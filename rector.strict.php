<?php

declare(strict_types=1);

use Rector\Configuration\RectorConfigBuilder;

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
    );
