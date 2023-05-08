<?php

namespace App\Domain\UseCases\Category;

use App\Domain\UseCases\Base\DeleteRecord;
use App\Presentation\Contracts\ICategoryRepository;

class DeleteCategoryById extends DeleteRecord
{
    public function __construct(
        ICategoryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
