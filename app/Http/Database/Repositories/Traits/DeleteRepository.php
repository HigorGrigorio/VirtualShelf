<?php

namespace App\Http\Database\Repositories\Traits;

use App\Http\Database\Repositories\Repository;

trait DeleteRepository
{
    public function delete(array $columns): int
    {
        $models = $this->getDao()->where($columns)->get();
        $affectedRows = 0;

        if ($models) {
            for ($i = 0; $i < count($models); $i++) {
                $affectedRows += $models[$i]->delete();
            }
        }

        return $affectedRows;
    }
}
