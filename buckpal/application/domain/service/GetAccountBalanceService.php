<?php

namespace Buckpul\Application\Domain\Service;

use Buckpul\Application\Domain\Model\AccountId;
use Buckpul\Application\Domain\Model\Money;
use Buckpul\Application\port\in\GetAccountBalanceQueryInterface;
use Buckpul\Application\port\out\LoadAccountPortInterface;

class GetAccountBalanceService implements GetAccountBalanceQueryInterface
{
    public function __construct(private readonly LoadAccountPortInterface $loadAccountPort)
    {
    }

    public function getAccountBalance(AccountId $accountId): Money
    {
        return $this->loadAccountPort->loadAccount($accountId, new \DateTime())
            ->calculateBalance();
    }
}
