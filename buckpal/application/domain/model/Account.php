<?php

namespace Buckpul\Application\Domain\Model;

class Account
{
    public function __construct(
        private readonly AccountId $id,
        private readonly Money     $baselineBalance,
        private readonly ActivityWindow $activityWindow
    ) {
    }

    public function calculateBalance(): Money
    {
        return Money::add(
            $this->baselineBalance,
            $this->activityWindow->calculateBalance($this->id)
        );
    }

    public function withdraw(Money $money, AccountId $targetAccountId): bool
    {
        if (!$this->mayWithdraw($money)) {
            return false;
        }

        $withdrawal = new Activity(
            $this->id,
            $this->id,
            $targetAccountId,
            new \DateTime(),
            $money
        );
        $this->activityWindow->addActivity($withdrawal);

        return true;
    }

    public function deposit(Money $money, AccountId $sourceAccountId): bool
    {
        $deposit = new Activity(
            $this->id,
            $sourceAccountId,
            $this->id,
            new \DateTime(),
            $money
        );
        $this->activityWindow->addActivity($deposit);

        return true;
    }

    public static function withId(
        AccountId $accountId,
        Money $baselineBalance,
        ActivityWindow $activityWindow
    ): Account
    {
        return new Account($accountId, $baselineBalance, $activityWindow);
    }

    private function mayWithdraw(Money $money): bool
    {
		return Money::add($this->calculateBalance(), $money->negate())
            ->isPositiveOrZero();
	}
}
