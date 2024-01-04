<?php

namespace Buckpul\Application\Domain\Model;

use Illuminate\Support\Collection;

class ActivityWindow
{
    public function __construct(private readonly Collection $activities)
    {
    }

    public function calculateBalance(AccountId $accountId): Money
    {
        /** @var Money $depositBalance */
        $depositBalance = $this->activities
            ->filter(fn(Activity $a) => $a->getTargetAccountId()->equals($accountId))
            ->map(fn(Activity $a) => $a->getMoney())
            ->reduce(fn(Money $carry, Money $m) => Money::add($carry, $m), Money::zero());

        /** @var Money $withdrawalBalance */
        $withdrawalBalance = $this->activities
            ->filter(fn(Activity $a) => $a->getSourceAccountId()->equals($accountId))
            ->map(fn(Activity $a) => $a->getMoney())
            ->reduce(fn(Money $carry, Money $m) => Money::add($carry, $m), Money::zero());

        return Money::add($depositBalance, $withdrawalBalance->negate());
    }

    public function addActivity(Activity $activity): void
    {
        $this->activities->add($activity);
    }

    public function getActivities(): Collection
    {
        return $this->activities;
    }
}
