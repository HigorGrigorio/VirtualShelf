<?php

namespace App\Core\Infra\Traits;

use Illuminate\Validation\Validator;

trait HasValidator
{
    protected function rules(): array
    {
        return [];
    }

    protected function messages(): array
    {
        return [];
    }

    public function validator($data): Validator
    {
        return \Illuminate\Support\Facades\Validator::make(
            $data,
            $this->rules(),
            $this->messages()
        );
    }
}
