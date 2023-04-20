<?php

namespace App\Domain\UseCases\Category;

use App\Domain\UseCases\Base\LoadRecords;
use App\Presentation\Interfaces\ICategoryRepository;

class LoadCategories extends LoadRecords
{
    public function __construct(
       readonly ICategoryRepository $repository
    )
    {
        parent::__construct($repository);
    }

}
