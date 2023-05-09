<?php

namespace App\Domain\UseCases\Category;

use App\Domain\UseCases\Base\ExportRecord;
use App\Http\Database\Contracts\CategoryRepository;

class ExportCategories extends ExportRecord
{
    public function __construct(
        readonly CategoryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
