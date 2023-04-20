<?php

namespace App\Http\Database\Repositories;

use App\Core\Logic\Maybe;
use App\Models\Language;
use App\Presentation\Interfaces\ILanguageRepository;

class LanguageRepository extends Repository implements ILanguageRepository
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
        return $this->getBy('acronym', $acronym);
    }
}
