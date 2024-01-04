<?php

namespace Buckpul\Application\Domain\Model;

final class AccountId
{
    public function __construct(private int $value)
    {
    }

    public function equals(AccountId $accountId): bool
    {
        return $accountId->value === $this->value;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
