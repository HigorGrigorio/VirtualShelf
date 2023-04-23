<?php

namespace App\Domain\UseCases\Category;

use App\Domain\UseCases\Base\CreateRecord;
use App\Presentation\Interfaces\ICategoryRepository;

class CreateCategory extends CreateRecord
{
    public function __construct(
        readonly ICategoryRepository $repository
    )
    {
        parent::__construct($this->repository);
    }
}