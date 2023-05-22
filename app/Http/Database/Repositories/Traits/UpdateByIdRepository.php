<?php

namespace App\Http\Database\Repositories\Traits;

use App\Http\Database\Repositories\Repository;

trait UpdateByIdRepository
{
    public function updateById(int $id, array $data): bool
    {
        $model = $this->dao->where(['id' => $id])->first();
        $updated = false;

        if ($model) {
            $model->update($data);
            $updated = true;
        }

        return $updated;
    }
}
