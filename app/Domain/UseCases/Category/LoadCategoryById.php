<?php

namespace App\Domain\UseCases\Category;

use App\Domain\UseCases\Base\LoadRecordById;
use App\Http\Database\Contracts\ICategoryRepository;

class LoadCategoryById extends LoadRecordById
{
    public function __construct(
        readonly ICategoryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
