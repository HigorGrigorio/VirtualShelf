<?php

namespace App\Http\Database\Contracts;

use App\Core\Logic\Maybe;

interface LanguageRepository extends Repository
{
    public function getLanguageByName(string $name): Maybe;

    public function getLanguageByCode(string $code): Maybe;
}
