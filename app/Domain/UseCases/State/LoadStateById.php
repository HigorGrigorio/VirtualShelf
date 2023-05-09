<?php

namespace App\Domain\UseCases\State;

use App\Domain\UseCases\Base\LoadRecordById;
use App\Http\Database\Contracts\StateRepository;

class LoadStateById extends LoadRecordById
{
    public function __construct(
        StateRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
