<?php

namespace App\Http\Database\Contracts;

use App\Core\Logic\Maybe;

interface ExportRepository extends Repository
{
    public function export(array $columns): Maybe;
}
