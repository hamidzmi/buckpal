<?php

namespace Buckpul\Adapter\Out\Persistence;

use Illuminate\Support\Collection;

class ActivityRepository
{
    public function findByOwnerSince(int $ownerAccountId, \DateTime $since): Collection
    {

    }

    public function getDepositBalanceUntil(int $accountId, \DateTime $until): int
    {

    }

    public function getWithdrawalBalanceUntil(int $accountId, \DateTime $until): int
    {

    }
}
