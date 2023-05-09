<?php

namespace App\Domain\UseCases\State;

use App\Domain\UseCases\Base\CreateRecord;
use App\Http\Database\Contracts\StateRepository;

class CreateState extends CreateRecord
{
    public function __construct(
        StateRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
