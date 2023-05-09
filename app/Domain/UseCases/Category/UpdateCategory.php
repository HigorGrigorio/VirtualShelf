<?php

namespace App\Domain\UseCases\Category;

use App\Domain\UseCases\Base\UpdateRecord;
use App\Http\Database\Contracts\CategoryRepository;

class UpdateCategory extends UpdateRecord
{

    public function __construct(
        CategoryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
