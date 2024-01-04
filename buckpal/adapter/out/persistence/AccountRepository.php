<?php

namespace Buckpul\Adapter\Out\Persistence;

class AccountRepository
{
    public function findById(int $id)
    {
        return AccountEloquentModel::query()->find($id);
    }
}
