<?php

namespace App\Domain\UseCases\Category;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\ICategoryRepository;

class CreateCategory implements \App\Core\Domain\IUseCase
{
    public function __construct(
        private readonly ICategoryRepository $repository
    )
    {
    }

    public function execute($data): Result
    {
        try {
            $data = [
                'name' => $data['name'],
                'slug' => $data['slug'],
                'description' => $data['description']
            ];

            $id = $this->repository->create($data);
            $result = Result::accept(Maybe::flat($id), 'Category created successfully');
        } catch (\Throwable $e) {
            $result = Result::reject(Maybe::nothing(), $e->getMessage());
        }

        return $result;
    }
}
