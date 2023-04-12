<?php

namespace App\Domain\UseCases\Category;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\ICategoryRepository;

class DeleteCategoryById implements IUseCase
{
    public function __construct(
        private readonly ICategoryRepository $repository
    )
    {
    }

    public function execute($data): Result
    {
        try {
            $id = $data['id'] ?? null;
            if (is_null($id))
                $result = Result::reject(
                    Maybe::nothing(),
                    'Invalid category id'
                );
            else {
                if ($this->repository->delete(['id' => $id]) == 0)
                    $result = Result::reject(
                        Maybe::nothing(),
                        'Category not found'
                    );
                else
                    $result = Result::accept(
                        Maybe::just(1),
                        'Category deleted successfully'
                    );
            }
        } catch (\Exception $e) {
            return Result::from($e);
        }

        return $result;
    }
}
