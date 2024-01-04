<?php

namespace Buckpul\Application\Domain\Model;

class Money
{
    public function __construct(private readonly int $amount)
    {
    }

    public static function zero(): Money
    {
        return new Money(0);
    }

    public static function of(int $value): Money
    {
        return new Money($value);
    }

    public static function add(Money $a, Money $b): Money
    {
        return new Money($a->amount + $b->amount);
    }

    public function negate(): Money
    {
        return new Money(-1 * abs($this->amount));
    }

    public function isPositiveOrZero(): bool
    {
        return $this->amount >= 0;
    }

    public static function subtract(Money $a, Money $b): Money
    {
        return new Money($a->amount - $b->amount);
    }
}
