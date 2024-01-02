<?php

namespace Buckpul\Application\port\in;

use Buckpul\Application\Domain\Model\AccountId;
use Buckpul\Application\Domain\Model\Money;

interface GetAccountBalanceQueryInterface
{
    public function getAccountBalance(AccountId $accountId): Money;
}
