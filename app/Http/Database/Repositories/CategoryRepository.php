<?php

namespace App\Http\Database\Repositories;

use App\Core\Logic\Maybe;
use App\Models\Category;
use App\Presentation\Contracts\ICategoryRepository;

class CategoryRepository extends Repository implements ICategoryRepository
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
