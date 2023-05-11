<?php

namespace App\Http\Database\Repositories;

use App\Core\Logic\Maybe;
use App\Models\State;
use App\Http\Database\Contracts\StateRepository as RepositoryContract;

class StateRepository extends Repository implements RepositoryContract
{
    public function __construct(
        readonly State $dao
    )
    {
        parent::__construct($dao);
    }

    protected function relations(): array
    {
        return ['country'];
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
