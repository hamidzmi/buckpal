<?php

namespace Buckpul\Application\port\out;

use Buckpul\Application\Domain\Model\Account;
use Buckpul\Application\Domain\Model\AccountId;

interface LoadAccountPortInterface
{
    public function loadAccount(AccountId $accountId, \DateTime $baselineDate): Account;
}
