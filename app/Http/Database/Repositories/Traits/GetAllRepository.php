<?php

namespace App\Http\Database\Repositories\Traits;

use App\Http\Database\Repositories\Repository;

trait GetAllRepository
{
    public function getAll(): array
    {
        return $this
            ->getDao()
            ->all()
            ->toArray();
    }
}
