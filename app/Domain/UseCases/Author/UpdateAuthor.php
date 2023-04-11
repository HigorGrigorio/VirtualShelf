<?php

namespace App\Domain\UseCases\Author;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\IAuthorRepository;

class UpdateAuthor implements \App\Core\Domain\UseCase
{

    public function __construct(
        private readonly IAuthorRepository $authorRepository,
    )
    {
    }

    public function execute($options): Result
    {
        try {
            if (!isset($options['id']))
                $result = Result::reject(
                    Maybe::nothing(),
                    'Author id is required'
                );
            else {
                $raw = [
                    'name' => $options['name'] ?? null,
                    'surname' => $options['surname'] ?? null,
                ];

                $id = $options['id'];

                if (!$this->authorRepository->update($raw, compact('id')))
                    $result = Result::reject(
                        Maybe::nothing(),
                        'Author not found'
                    );
                else
                    $result = Result::accept(
                        Maybe::just(
                            $this->authorRepository->getById($id)
                        ),
                        'Author updated successfully'
                    );
            }

        } catch (\Exception $e) {
            $result = Result::from($e);
        }

        return $result;
    }
}
