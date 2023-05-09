<?php

namespace App\Domain\UseCases\Category;

use App\Domain\UseCases\Base\ExportRecord;
use App\Http\Database\Contracts\ICategoryRepository;

class ExportCategories extends ExportRecord
{
    public function __construct(
        readonly ICategoryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
