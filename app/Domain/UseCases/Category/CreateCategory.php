<?php

namespace App\Domain\UseCases\Category;

use App\Domain\UseCases\Base\CreateRecord;
use App\Http\Database\Contracts\ICategoryRepository;

class CreateCategory extends CreateRecord
{
    public function __construct(
        ICategoryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
