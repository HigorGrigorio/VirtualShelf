<?php

namespace App\Domain\UseCases\Category;

use App\Domain\UseCases\Base\CreateRecord;
use App\Http\Database\Contracts\CategoryRepository;

class CreateCategory extends CreateRecord
{
    public function __construct(
        CategoryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
