<?php

namespace App\Http\Database\Contracts;

interface PublisherLanguageRepository extends PaginateRepository, GetByIdRepository, UpdateRepository, \App\Http\Database\Contracts\DeleteRepository
{
    public function addLanguageToPublisher(int $publisherId, int $languageId): int;

    public function removeLanguageFromPublisher(int $publisherId, int $languageId): int;

}
