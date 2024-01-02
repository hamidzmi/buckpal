<?php

namespace Buckpul\Adapter\In\Web;

use Buckpul\Application\Domain\Model\AccountId;
use Buckpul\Application\Domain\Model\Money;
use Buckpul\Application\port\in\SendMoneyCommand;
use Buckpul\Application\port\in\SendMoneyUseCaseInterface;
use Illuminate\Routing\Controller as BaseController;

class SendMoneyController extends BaseController
{
    public function __construct(private SendMoneyUseCaseInterface $sendMoneyUseCase)
    {
    }

    /**
     * @throws \Exception
     */
    public function sendMoney(int $sourceAccountId, int $targetAccountId, int $amount): void
    {
        $command = new SendMoneyCommand(
            new AccountId($sourceAccountId),
            new AccountId($targetAccountId),
            Money::of($amount),
        );

        $this->sendMoneyUseCase->sendMoney($command);
    }
}
