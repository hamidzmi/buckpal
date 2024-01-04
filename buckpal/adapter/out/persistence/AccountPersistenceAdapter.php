<?php

namespace Buckpul\Adapter\Out\Persistence;

use Buckpul\Application\Domain\Model\Account;
use Buckpul\Application\Domain\Model\AccountId;
use Buckpul\Application\port\out\LoadAccountPortInterface;

class AccountPersistenceAdapter implements LoadAccountPortInterface
{
    public function __construct(
        private readonly AccountRepository  $accountRepository,
        private readonly ActivityRepository $activityRepository,
        private readonly AccountMapper $accountMapper
    ) {
    }

    public function loadAccount(AccountId $accountId, \DateTime $baselineDate): Account
    {
        $account = $this->accountRepository->findById($accountId->getValue());
        $activities = $this->activityRepository->findByOwnerSince($accountId->getValue(), $baselineDate);
        $withdrawalBalance = $this->activityRepository->getWithdrawalBalanceUntil($accountId->getValue(), $baselineDate);
        $depositBalance = $this->activityRepository->getDepositBalanceUntil($accountId->getValue(), $baselineDate);

        return $this->accountMapper->mapToDomainEntity(
            $account,
            $activities,
            $withdrawalBalance,
            $depositBalance
        );
    }
}
