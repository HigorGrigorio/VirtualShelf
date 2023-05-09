<?php

namespace App\Domain\UseCases\Category;

use App\Domain\UseCases\Base\UpdateRecord;
use App\Http\Database\Contracts\ICategoryRepository;

class UpdateCategory extends UpdateRecord
{

    public function __construct(
        ICategoryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
