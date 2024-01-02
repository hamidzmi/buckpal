<?php

namespace Buckpul\Application\port\in;

use Buckpul\Application\Domain\Model\AccountId;
use Buckpul\Application\Domain\Model\Money;
use Buckpul\common\validation\AbstractSelfValidating;
use Illuminate\Support\Facades\Validator;

class SendMoneyCommand extends AbstractSelfValidating
{
    private readonly AccountId $sourceAccountId;
    private readonly AccountId $targetAccountId;
    private readonly Money $money;

    /**
     * @throws \Exception
     */
    public function __construct(
        AccountId $sourceAccountId,
        AccountId $targetAccountId,
        Money $money,
    ) {
        Validator::make(func_get_args(), [
            'sourceAccountId' => 'required',
            'targetAccountId' => 'required',
            'money' => 'required',
        ]);
        $this->sourceAccountId = $sourceAccountId;
        $this->targetAccountId = $targetAccountId;
        $this->money = $money;
        $this->validateSelf();
    }

    public function rules(): array
    {
        return [
            'sourceAccountId' => 'required',
            'targetAccountId' => 'required',
            'money' => 'required|gt:0',
        ];
    }

    public function getSourceAccountId(): AccountId
    {
        return $this->sourceAccountId;
    }

    public function getTargetAccountId(): AccountId
    {
        return $this->targetAccountId;
    }

    public function getMoney(): Money
    {
        return $this->money;
    }
}
