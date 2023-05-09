<?php

namespace App\Domain\UseCases\Category;

use App\Domain\UseCases\Base\LoadRecords;
use App\Http\Database\Contracts\CategoryRepository;

class LoadCategories extends LoadRecords
{
    public function __construct(
        CategoryRepository $repository
    )
    {
        parent::__construct($repository);
    }

}
