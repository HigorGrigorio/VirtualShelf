<?php

namespace App\Domain\UseCases\Category;

use App\Domain\UseCases\Base\LoadRecords;
use App\Presentation\Contracts\ICategoryRepository;

class LoadCategories extends LoadRecords
{
    public function __construct(
       ICategoryRepository $repository
    )
    {
        parent::__construct($repository);
    }

}
