<?php

declare(strict_types=1);

namespace WickedByte\EmbracingEnums\Traits;

/**
 * @phpstan-require-implements \BackedEnum
 */
trait HasBackedEnumFunctionality
{
    public static function instance(int|string|self $value): static
    {
        return $value instanceof static ? $value : self::from($value);
    }

    public static function values(): array
    {
        return \array_column(self::cases(), 'value', 'name');
    }
}