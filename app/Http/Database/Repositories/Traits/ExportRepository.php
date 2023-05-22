<?php

namespace App\Http\Database\Repositories\Traits;

use App\Core\Logic\Maybe;

trait ExportRepository
{
    public function export(array $columns): Maybe
    {
        return Maybe::flat($this->dao->select($columns)->get(), ['array' => false]);
    }
}
