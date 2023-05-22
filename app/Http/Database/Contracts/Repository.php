<?php

namespace App\Http\Database\Contracts;

use App\Core\Logic\Maybe;
use Illuminate\Database\Eloquent\Model;

interface Repository
{
    public function getBy(string $column, string $value): Maybe;

    public function getDao(): Model;

    public function relations(): array;
}
