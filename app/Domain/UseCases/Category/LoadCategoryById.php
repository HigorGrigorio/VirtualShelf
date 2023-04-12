<?php

namespace App\Domain\UseCases\Category;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\ICategoryRepository;

class LoadCategoryById implements IUseCase
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
                $result = Result::reject(Maybe::nothing(), 'Invalid category id');
            else {
                $maybe = $this->repository->getById($id);

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
