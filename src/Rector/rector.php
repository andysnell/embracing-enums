<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use WickedByte\EmbracingEnums\HttpMethod;
use WickedByte\src\Rector\StringToBackedEnumValue;
use WickedByte\src\Rector\StringToBackedEnumValueRector;

return RectorConfig::configure()
    ->withConfiguredRule(StringToBackedEnumValueRector::class, \array_map(
        StringToBackedEnumValue::make(...),
        HttpMethod::cases(),
    ));
