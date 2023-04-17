<?php

namespace App\Domain\UseCases\Category;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\Base\UpdateRecord;
use App\Interfaces\ICategoryRepository;

class UpdateCategory extends UpdateRecord
{

    public function __construct(
        private readonly ICategoryRepository $repository
    )
    {
        parent::__construct($this->repository);
    }
}
