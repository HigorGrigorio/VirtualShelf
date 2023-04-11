<?php

namespace App\Domain\UseCases\Author;

use App\Core\Domain\UseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\IAuthorRepository;

class DeleteAuthorById implements UseCase
{
    public function __construct(
        private readonly IAuthorRepository $authorRepository,
    )
    {
    }

    public function execute($options): Result
    {
        try {
            $id = $options['id'] ?? null;
            if (is_null($id))
                $result = Result::reject(
                    Maybe::nothing(),
                    'Invalid author id'
                );
            else {
                if ($this->authorRepository->delete(['id' => $id]) == 0)
                    $result = Result::reject(
                        Maybe::nothing(),
                        'Author not found'
                    );
                else
                    $result = Result::accept(
                        Maybe::just(1),
                        'Author deleted successfully'
                    );
            }
        } catch (\Exception $e) {
            return Result::from($e);
        }

        return $result;
    }
}
