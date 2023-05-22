<?php

namespace App\Http\Database\Repositories\Traits;

use App\Core\Logic\Maybe;
use App\Http\Database\Repositories\Repository;

trait GetByIdRepository
{
    public function getById($id): Maybe
    {
        return Maybe::flat(
            $this
                ->getQueryBuilderWithRelations()
                ->find($id)
        );
    }
}
