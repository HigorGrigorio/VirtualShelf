<?php

namespace App\Domain\UseCases\Language;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\ILanguageRepository;

class UpdateLanguage implements \App\Core\Domain\UseCase
{

    public function __construct(
        private readonly ILanguageRepository $languageRepository
    )
    {
    }

    public function execute($data): Result
    {
        try {
            if (!isset($data['id']))
                $result = Result::reject(
                    Maybe::nothing(),
                    'Language id is required'
                );
            else {
                $raw = [
                    'name' => $data['name'] ?? null,
                    'acronym' => $data['acronym'] ?? null,
                ];

                $id = $data['id'];

                if (!$this->languageRepository->update($raw, compact('id')))
                    $result = Result::reject(
                        Maybe::nothing(),
                        'Language not found'
                    );
                else
                    $result = Result::accept(
                        Maybe::just(
                            $this->languageRepository->getById($id)
                        ),
                        'Language updated successfully'
                    );
            }

        } catch (\Exception $e) {
            $result = Result::from($e);
        }

        return $result;
    }
}
