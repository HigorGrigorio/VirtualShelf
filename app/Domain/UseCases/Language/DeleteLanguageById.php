<?php

namespace App\Domain\UseCases\Language;

use App\Core\Domain\UseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\IAuthorRepository;
use App\Interfaces\ILanguageRepository;

class DeleteLanguageById implements UseCase
{
    public function __construct(
        private readonly ILanguageRepository $languageRepository
    )
    {
    }

    public function execute($data): Result
    {
        try {
            $id = $data['id'] ?? null;
            if (is_null($id))
                $result = Result::reject(
                    Maybe::nothing(),
                    'Invalid language id'
                );
            else {
                if ($this->languageRepository->delete(['id' => $id]) == 0)
                    $result = Result::reject(
                        Maybe::nothing(),
                        'Language not found'
                    );
                else
                    $result = Result::accept(
                        Maybe::just(1),
                        'Language deleted successfully'
                    );
            }
        } catch (\Exception $e) {
            return Result::from($e);
        }

        return $result;
    }
}
