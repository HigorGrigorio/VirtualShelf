<?php

namespace App\Domain\UseCases\Language;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\IAuthorRepository;
use App\Interfaces\ILanguageRepository;
use Illuminate\Support\Facades\Config;

class LoadLanguages implements \App\Core\Domain\IUseCase
{
    public function __construct(
        private readonly ILanguageRepository $languageRepository
    )
    {
    }

    public function execute($data): Result
    {
        try {
            $search = $data['search'] ?? null;


            $page = $data['page'] ?? 1;
            $limit = $data['limit'] ?? Config::get('app.pagination.per_page');

            $languages = $this->languageRepository->paginate($page, $search, $limit);

            if (!$languages->count()) {
                $result = Result::reject(Maybe::flat($languages), 'Language not found');
            } else {
                $result = Result::accept(Maybe::flat($languages), 'Language loaded successfully');
            }
        } catch (\Exception $e) {
            $result = Result::reject(Maybe::just([]), $e->getMessage());
        }

        return $result;
    }
}
