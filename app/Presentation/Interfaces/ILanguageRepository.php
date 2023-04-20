<?php

namespace App\Interfaces;

use App\Core\Logic\Maybe;

interface ILanguageRepository extends IRepository
{
    public function getLanguageByName(string $name): Maybe;

    public function getLanguageByCode(string $code): Maybe;
}
