<?php

declare(strict_types=1);

namespace WickedByte\EmbracingEnums;

/**
 * While PHP enums are supposed to be stateless, it is possible to expose stateful
 * behavior within method scope. This is not intentional behavior and should not
 * be relied upon, as it may be fixed in future versions of PHP.
 */
enum StatefulEnum implements \Countable
{
    case A;
    case B;
    case C;

    public function count(): int
    {
        static $counter = 0;
        return ++$counter;
    }
}
