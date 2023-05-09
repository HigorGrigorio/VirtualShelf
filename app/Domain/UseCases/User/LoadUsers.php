<?php

namespace App\Domain\UseCases\User;

use App\Domain\UseCases\Base\LoadRecords;
use App\Http\Database\Contracts\UserRepository;

class LoadUsers extends LoadRecords
{
    public function __construct(
        readonly UserRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
