<?php

namespace App\Domain\UseCases\State;

use App\Domain\UseCases\Base\UpdateRecord;
use App\Http\Database\Contracts\StateRepository;

class UpdateState extends UpdateRecord
{
    public function __construct(
        StateRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
