<?php

namespace App\Domain\UseCases\Author;

use App\Core\Domain\UseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\IAuthorRepository;

class LoadAuthorById implements UseCase
{
    public function __construct(
        private readonly IAuthorRepository $authorRepository
    )
    {
    }

    public function execute($options): Result
    {
        try {
            $id = $options['id'] ?? null;

            if (is_null($id))
                $result = Result::reject(Maybe::nothing(), 'Invalid author id');
            else {
                $maybe = $this->authorRepository->getById($id);

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