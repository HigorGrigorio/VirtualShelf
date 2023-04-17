<?php

namespace App\Domain\UseCases\Category;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\Base\LoadRecords;
use App\Interfaces\IAuthorRepository;
use App\Interfaces\ICategoryRepository;
use Illuminate\Support\Facades\Config;

class LoadCategories extends LoadRecords
{
    public function __construct(
       readonly ICategoryRepository $repository
    )
    {
        parent::__construct($repository);
    }

}
