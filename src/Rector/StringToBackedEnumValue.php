<?php

declare(strict_types=1);

namespace WickedByte\EmbracingEnums\Rector;

final readonly class StringToBackedEnumValue
{
    /** @param array<string> $skip_files */
    public function __construct(
        public \BackedEnum $enum,
        public string|null $string = null,
        public array $skip_files = [],
    )
    {
    }

    /** @param array<string> $skip_files */
    public static function make(
        \BackedEnum $enum,
        string|null $string = null,
        array $skip_files = [],
    ): self
    {
        return new self($enum, $string, $skip_files);
    }
}
