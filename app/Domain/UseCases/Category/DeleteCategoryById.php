<?php

namespace App\Domain\UseCases\Category;

use App\Domain\UseCases\Base\DeleteRecord;
use App\Http\Database\Contracts\CategoryRepository;

class DeleteCategoryById extends DeleteRecord
{
    public function __construct(
        CategoryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
