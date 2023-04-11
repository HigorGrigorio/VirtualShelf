<?php

namespace App\Domain\UseCases\Author;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\IAuthorRepository;

class CreateAuthor implements \App\Core\Domain\UseCase
{
    public function __construct(
        private readonly IAuthorRepository $authorRepository
    )
    {
    }

    public function execute($options): Result
    {
        try {
            $id = $this->authorRepository->create($options);
            $result = Result::accept(Maybe::flat($id), 'Author created successfully');
        } catch (\Throwable $e) {
            $result = Result::reject(Maybe::nothing(), $e->getMessage());
        }

        return $result;
    }
}
