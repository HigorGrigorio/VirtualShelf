<?php

namespace App\Http\Database\Repositories;

use App\Core\Logic\Maybe;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Database\Contracts\StateRepository as RepositoryContract;

class StateRepository extends Repository implements RepositoryContract
{
    public function __construct(
        readonly Country $dao
    )
    {
        parent::__construct($dao);
    }

    public function getStateByName(string $name): Maybe
    {
        return $this->getBy('name', $name);
    }

    public function getStateByCode(string $code): Maybe
    {
        return $this->getBy('code', $code);
    }
}
