<?php

namespace Buckpul\Application\Domain\Model;

class Activity
{
    public function __construct(
        private ?ActivityId $id,
        private AccountId $ownerAccountId,
        private AccountId $sourceAccountId,
        private AccountId $targetAccountId,
        private \DateTime $timestamp,
        private Money $money
    ) {
        $this->id = null;
    }

    public function getId(): ActivityId
    {
        return $this->id;
    }

    public function getOwnerAccountId(): AccountId
    {
        return $this->ownerAccountId;
    }

    public function getSourceAccountId(): AccountId
    {
        return $this->sourceAccountId;
    }

    public function getTargetAccountId(): AccountId
    {
        return $this->targetAccountId;
    }

    public function getTimestamp(): \DateTime
    {
        return $this->timestamp;
    }

    public function getMoney(): Money
    {
        return $this->money;
    }
}
