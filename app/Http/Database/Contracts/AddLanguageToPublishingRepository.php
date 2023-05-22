<?php

namespace App\Http\Database\Contracts;

interface AddLanguageToPublishingRepository
{
    public function addLanguageToPublishing(int $publishingId, int $languageId): int;
}
