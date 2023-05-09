<?php

namespace App\Http\Database\Repositories;

use App\Core\Logic\Maybe;
use App\Http\Database\Contracts\CategoryRepository as RepositoryContract;
use App\Models\Category;

class CategoryRepository extends Repository implements RepositoryContract
{
    public function __construct(
        readonly Category $dao
    )
    {
        parent::__construct($dao);
    }

    public function getCategoryByName(string $name): Maybe
    {
        return $this->getBy('name', $name);
    }

    public function getCategoryBySlug(string $slug): Maybe
    {
        return $this->getBy('slug', $slug);
    }
}
