<?php

namespace Buckpul\common\validation;

use Illuminate\Support\Facades\Validator;

abstract class AbstractSelfValidating
{
    abstract public function rules(): array;

    protected function validateSelf(): void
    {
        $validator = Validator::make(
            (array) $this,
            $this->rules()
        );

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }
}
