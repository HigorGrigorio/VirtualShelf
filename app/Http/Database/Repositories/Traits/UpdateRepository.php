<?php

namespace App\Http\Database\Repositories\Traits;

use App\Http\Database\Repositories\Repository;

trait UpdateRepository
{
    public function update(array $columns, array $data): int
    {
        $models = $this->dao->where($data)->get();

        $affectedRows = 0;

        if ($models) {
            for ($i = 0; $i < count($models); $i++) {
                if ($models[$i]->update($columns)) {
                    $models[$i]->save();
                    $affectedRows++;
                }
            }
        }

        return $affectedRows;
    }
}
