<?php

namespace App\Domain\UseCases\Category;

use App\Domain\UseCases\Base\LoadRecordById;
use App\Http\Database\Contracts\CategoryRepository;

class LoadCategoryById extends LoadRecordById
{
    public function __construct(
        readonly CategoryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
