<?php

namespace App\Presentation\Interfaces;

use App\Core\Logic\Maybe;

interface ICategoryRepository extends IRepository
{
    public function getCategoryByName(string $name): Maybe;
    public function getCategoryBySlug(string $slug): Maybe;
}
