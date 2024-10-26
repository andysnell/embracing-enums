<?php

declare(strict_types=1);

namespace WickedByte\EmbracingEnums;

use WickedByte\EmbracingEnums\Traits\HasBackedEnumFunctionality;

enum CardSuit: string implements CardElement
{
    use HasBackedEnumFunctionality;

    public const self CLOVERS = self::Clubs;

    case Clubs = '♣';
    case Diamonds = '♦';
    case Hearts = '♥';
    case Spades = '♠';

    public function order(): int
    {
        return match ($this) {
            self::Clubs => 1,
            self::Diamonds => 2,
            self::Hearts => 3,
            self::Spades => 4,
        };
    }

}


CardSuit::instance('♣') === CardSuit::Clubs;
CardSuit::instance(CardSuit::Diamonds) === CardSuit::Diamonds;

CardSuit::values() === [
    'CLUBS' => '♣',
    'DIAMONDS' => '♦',
    'HEARTS' => '♥',
    'SPADES' => '♠',
];
