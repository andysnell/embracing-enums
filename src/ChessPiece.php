<?php

declare(strict_types=1);

namespace WickedByte\EmbracingEnums;

enum ChessPiece
{
    case Pawn;
    case Knight;
    case Bishop;
    case Rook;
    case Queen;
    case King;

    public function __invoke(): int
    {
        return match ($this) {
            self::King, self::Queen => 1,
            self::Rook, self::Bishop, self::Knight => 2,
            self::Pawn => 8,
        };
    }
}
