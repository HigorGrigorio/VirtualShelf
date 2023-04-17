<?php

namespace App\Domain\UseCases\Category;

use App\Domain\UseCases\Base\DeleteRecord;
use App\Interfaces\ICategoryRepository;

class DeleteCategoryById extends DeleteRecord
{
    public function __construct(
        readonly ICategoryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
