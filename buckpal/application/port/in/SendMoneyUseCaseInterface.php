<?php

namespace Buckpul\Application\port\in;

interface SendMoneyUseCaseInterface
{
    public function sendMoney(SendMoneyCommand $command);
}
