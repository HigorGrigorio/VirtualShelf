<?php

namespace App\Domain\UseCases\Category;

use App\Domain\UseCases\Base\UpdateRecord;
use App\Presentation\Contracts\ICategoryRepository;

class UpdateCategory extends UpdateRecord
{

    public function __construct(
        ICategoryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
