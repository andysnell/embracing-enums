<?php

declare(strict_types=1);

namespace WickedByte\EmbracingEnums;

enum CardRank: string implements CardElement
{
    case Ace = 'A';
    case Two = '2';
    case Three = '3';
    case Four = '4';
    case Five = '5';
    case Six = '6';
    case Seven = '7';
    case Eight = '8';
    case Nine = '9';
    case Ten = 'T';
    case Jack = 'J';
    case Queen = 'Q';
    case King = 'K';

    private const array ORDER = [
        CardRank::Two->name => 0b0000000000001,
        CardRank::Three->name => 0b0000000000010,
        CardRank::Four->name => 0b0000000000100,
        CardRank::Five->name => 0b0000000001000,
        CardRank::Six->name => 0b0000000010000,
        CardRank::Seven->name => 0b0000000100000,
        CardRank::Eight->name => 0b0000001000000,
        CardRank::Nine->name => 0b0000010000000,
        CardRank::Ten->name => 0b0000100000000,
        CardRank::Jack->name => 0b0001000000000,
        CardRank::Queen->name => 0b0010000000000,
        CardRank::King->name => 0b0100000000000,
        CardRank::Ace->name => 0b1000000000000,
    ];

    public function order(bool $ace_high = true): int
    {
        return match ($this) {
            self::Two => 0b0000000000001,
            self::Three => 0b0000000000010,
            self::Four => 0b0000000000100,
            self::Five => 0b0000000001000,
            self::Six => 0b0000000010000,
            self::Seven => 0b0000000100000,
            self::Eight => 0b0000001000000,
            self::Nine => 0b0000010000000,
            self::Ten => 0b0000100000000,
            self::Jack => 0b0001000000000,
            self::Queen => 0b0010000000000,
            self::King => 0b0100000000000,
            self::Ace => $ace_high ? 0b1000000000000 : 0,
        };
    }
}
