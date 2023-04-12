<?php

namespace App\Domain\UseCases\Author;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\IAuthorRepository;

class UpdateAuthor implements \App\Core\Domain\IUseCase
{

    public function __construct(
        private readonly IAuthorRepository $authorRepository,
    )
    {
    }

    public function execute($data): Result
    {
        try {
            if (!isset($data['id']))
                $result = Result::reject(
                    Maybe::nothing(),
                    'Author id is required'
                );
            else {
                $raw = [
                    'name' => $data['name'] ?? null,
                    'surname' => $data['surname'] ?? null,
                ];

                $id = $data['id'];

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
