<?php

namespace Buckpul\Application\Domain\Service;

use Buckpul\Application\port\in\SendMoneyCommand;
use Buckpul\Application\port\in\SendMoneyUseCaseInterface;

class SendMoneyService implements SendMoneyUseCaseInterface
{
    public function sendMoney(SendMoneyCommand $command)
    {
        // TODO: validate business rules
        // TODO: manipulate model state
        // TODO: return output
    }
}
