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

    public function execute($data): Result
    {
        try {
            $raw = [
                'name' => $data['name'],
                'surname' => $data['surname'],
            ];

            $id = $this->authorRepository->create($raw);
            $result = Result::accept(Maybe::flat($id), 'Author created successfully');
        } catch (\Throwable $e) {
            $result = Result::reject(Maybe::nothing(), $e->getMessage());
        }

        return $result;
    }
}
