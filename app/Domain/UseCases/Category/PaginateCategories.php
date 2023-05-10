<?php

namespace App\Domain\UseCases\Category;

use App\Domain\UseCases\Base\PaginateRecords;
use App\Http\Database\Contracts\CategoryRepository;

class PaginateCategories extends PaginateRecords
{
    public function __construct(
        CategoryRepository $repository
    )
    {
        parent::__construct($repository);
    }

}
