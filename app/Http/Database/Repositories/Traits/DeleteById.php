<?php

namespace App\Http\Database\Repositories\Traits;

trait DeleteById
{
    public function deleteById(int $id): int
    {
        $model = $this->getDao()->where(['id' => $id])->first();
        $affectedRows = 0;

        if ($model) {
            $affectedRows = 1;
            $model->delete();
        }

        return $affectedRows;
    }

}
