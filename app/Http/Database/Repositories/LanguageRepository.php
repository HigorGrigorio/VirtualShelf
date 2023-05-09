<?php

namespace App\Http\Database\Repositories;

use App\Core\Logic\Maybe;
use App\Http\Database\Contracts\LanguageRepository as RepositoryContract;
use App\Models\Language;

class LanguageRepository extends Repository implements RepositoryContract
{
    public function __construct(
        readonly Language $dao
    )
    {
        parent::__construct($dao);
    }


    public function getLanguageByName(string $name): Maybe
    {
        return $this->getBy('name', $name);
    }

    public function getLanguageByCode(string $code): Maybe
    {
        return $this->getBy('acronym', $code);
    }
}
