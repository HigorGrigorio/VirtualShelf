<?php

namespace App\Domain\UseCases\User;

use App\Domain\UseCases\Base\LoadRecords;
use App\Http\Database\Contracts\IUserRepository;

class LoadUsers extends LoadRecords
{
    public function __construct(
        readonly IUserRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
