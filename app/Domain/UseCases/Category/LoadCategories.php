<?php

namespace App\Domain\UseCases\Category;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\IAuthorRepository;
use App\Interfaces\ICategoryRepository;
use Illuminate\Support\Facades\Config;

class LoadCategories implements IUseCase
{
    public function __construct(
        private readonly ICategoryRepository $repository
    )
    {
    }

    public function execute($data): Result
    {
        try {
            $search = $data['search'] ?? null;


            $page = $data['page'] ?? 1;
            $limit = $data['limit'] ?? Config::get('app.pagination.per_page');

            $languages = $this->repository->paginate($page, $search, $limit);

            if (!$languages->count()) {
                $result = Result::reject(Maybe::flat($languages), 'Category not found');
            } else {
                $result = Result::accept(Maybe::flat($languages), 'Category loaded successfully');
            }
        } catch (\Exception $e) {
            $result = Result::reject(Maybe::just([]), $e->getMessage());
        }

        return $result;
    }
}
