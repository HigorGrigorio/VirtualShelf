<?php

namespace App\Domain\UseCases\Category;

use App\Domain\UseCases\Base\UpdateRecord;
use App\Presentation\Interfaces\ICategoryRepository;

class UpdateCategory extends UpdateRecord
{

    public function __construct(
        private readonly ICategoryRepository $repository
    )
    {
        parent::__construct($this->repository);
    }
}
