<?php

namespace Buckpul\Adapter\Out\Persistence;

use Buckpul\Application\Domain\Model\Account;
use Buckpul\Application\Domain\Model\AccountId;
use Buckpul\Application\Domain\Model\Activity;
use Buckpul\Application\Domain\Model\ActivityId;
use Buckpul\Application\Domain\Model\ActivityWindow;
use Buckpul\Application\Domain\Model\Money;
use Illuminate\Support\Collection;

class AccountMapper
{
    public function mapToDomainEntity(
        AccountEloquentModel $account,
        Collection           $activities,
        int                  $withdrawalBalance,
        int                  $depositBalance
    ): Account {
        $baselineBalance = Money::subtract(
            Money::of($depositBalance),
            Money::of($withdrawalBalance)
        );

        return Account::withId(
            new AccountId($account->id),
            $baselineBalance,
            $this->mapToActivityWindow($activities)
        );
    }

    private function mapToActivityWindow(Collection $activities): ActivityWindow
    {
        $mappedActivities = new Collection();

        foreach ($activities as $activity) {
            $mappedActivities->add(new Activity(
                new ActivityId($activity->id),
                new AccountId($activity->ownerAccountId),
                new AccountId($activity->sourceAccountId),
                new AccountId($activity->targetAccountId),
                $activity->timestamp,
                Money::of($activity->amount)
            ));
        }

        return new ActivityWindow($mappedActivities);
    }
}
