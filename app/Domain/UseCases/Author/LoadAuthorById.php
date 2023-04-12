<?php

namespace App\Domain\UseCases\Author;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\IAuthorRepository;

class LoadAuthorById implements IUseCase
{
    public function __construct(
        private readonly IAuthorRepository $authorRepository
    )
    {
    }

    public function execute($data): Result
    {
        try {
            $id = $data['id'] ?? null;

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
