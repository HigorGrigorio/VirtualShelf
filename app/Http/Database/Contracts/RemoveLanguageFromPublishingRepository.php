<?php

namespace App\Http\Database\Contracts;

interface RemoveLanguageFromPublishingRepository
{
    public function removeLanguageFromPublisher (int $publishingId, int $languageId): int;
}
