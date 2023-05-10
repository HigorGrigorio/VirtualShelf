<?php

namespace App\Domain\UseCases\State;

use App\Domain\UseCases\Base\DeleteRecord;
use App\Http\Database\Contracts\StateRepository;

class DeleteStateById extends DeleteRecord
{
    public function __construct(
        StateRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
