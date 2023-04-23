<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

trait ValidatesRequests
{
    protected function validateRequest(Request $request): array
    {
        $rules = [];
        $messages = [];

        if (method_exists($this, 'rules')) {
            $rules = $this->rules();
        }

        if (method_exists($this, 'messages')) {
            $messages = $this->messages();
        }

        return $request->validate($rules, $messages);
    }
}
