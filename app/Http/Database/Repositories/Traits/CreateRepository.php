<?php

namespace App\Http\Database\Repositories\Traits;

use App\Http\Database\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

trait CreateRepository
{
    public function create(array $data): Model
    {
        return $this->getDao()->create($data);
    }
}
