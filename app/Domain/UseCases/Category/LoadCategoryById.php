<?php

namespace App\Domain\UseCases\Category;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\Base\LoadRecordById;
use App\Interfaces\ICategoryRepository;

class LoadCategoryById extends LoadRecordById
{
    public function __construct(
        readonly ICategoryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
