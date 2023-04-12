<?php

namespace App\Domain\UseCases\Language;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\ILanguageRepository;

class CreateLanguage implements \App\Core\Domain\IUseCase
{
    public function __construct(
        private readonly ILanguageRepository $authorRepository
    )
    {
    }

    public function execute($data): Result
    {
        try {
            $data = [
                'name' => $data['name'],
                'acronym' => $data['acronym'],
            ];

            $id = $this->authorRepository->create($data);
            $result = Result::accept(Maybe::flat($id), 'Language created successfully');
        } catch (\Throwable $e) {
            $result = Result::reject(Maybe::nothing(), $e->getMessage());
        }

        return $result;
    }
}
