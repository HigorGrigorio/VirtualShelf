<?php

namespace App\Domain\UseCases\Category;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\ICategoryRepository;

class UpdateCategory implements IUseCase
{

    public function __construct(
        private readonly ICategoryRepository $repository
    )
    {
    }

    public function execute($data): Result
    {
        try {
            if (!isset($data['id']))
                $result = Result::reject(
                    Maybe::nothing(),
                    'Category id is required'
                );
            else {
                $raw = [
                    'name' => $data['name'],
                    'slug' => $data['slug'],
                    'description' => $data['description']
                ];

                $id = $data['id'];

                if (!$this->repository->update($raw, compact('id')))
                    $result = Result::reject(
                        Maybe::nothing(),
                        'Category not found'
                    );
                else
                    $result = Result::accept(
                        Maybe::just(
                            $this->repository->getById($id)
                        ),
                        'Category updated successfully'
                    );
            }

        } catch (\Exception $e) {
            $result = Result::from($e);
        }

        return $result;
    }
}
