<?php

namespace App\Domain\UseCases\Category;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\Record\CreateRecord;
use App\Interfaces\ICategoryRepository;

class CreateCategory extends CreateRecord
{
    public function __construct(
        readonly ICategoryRepository $repository
    )
    {
        parent::__construct($this->repository);
    }
}
