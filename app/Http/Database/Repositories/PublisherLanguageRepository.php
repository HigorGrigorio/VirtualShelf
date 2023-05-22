<?php

namespace App\Http\Database\Repositories;

use App\Models\PublisherLanguage;
use Exception;

class PublisherLanguageRepository extends Repository
    implements \App\Http\Database\Contracts\PublisherLanguageRepository
{
    use Traits\PaginateRepository,
        Traits\GetByIdRepository,
        Traits\UpdateRepository,
        Traits\DeleteRepository;

    public function __construct(
        readonly PublisherLanguage $dao
    )
    {
        parent::__construct($dao);
    }


    /**
     * @throws Exception
     */
    public function addLanguageToPublisher(int $publisherId, int $languageId): int
    {
        if ($this->getDao()->where([
            'publisher_id' => $publisherId,
            'language_id' => $languageId
        ])->exists()) {
            throw new Exception('Language already added to publisher!');
        }

        return $this->getDao()->create([
            'publisher_id' => $publisherId,
            'language_id' => $languageId
        ])['id'];
    }

    /**
     * @throws Exception
     */
    public function removeLanguageFromPublisher(int $publishingId, int $languageId): int
    {
        if (!$this->getDao()->exists([
            'publisher_id' => $publishingId,
            'language_id' => $languageId
        ])) {
            throw new Exception('Language not added to publisher!');
        }

        return $this->getDao()->find([
            'publisher_id' => $publishingId,
            'language_id' => $languageId
        ])->delete();
    }
}
