<?php

namespace App\Domain\UseCases\Language;

use App\Core\Domain\UseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\IAuthorRepository;
use App\Interfaces\ILanguageRepository;

class LoadLanguageById implements UseCase
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
                $result = Result::reject(Maybe::nothing(), 'Invalid language id');
            else {
                $maybe = $this->languageRepository->getById($id);

                if ($maybe->isNothing())
                    $result = Result::reject(Maybe::nothing(), 'Country not found');
                else
                    $result = Result::accept($maybe);
            }
        } catch (\Exception $e) {
            $result = Result::from($e);
        }

        return $result;
    }
}
