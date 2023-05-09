<?php

namespace App\Domain\UseCases\User;

use App\Domain\UseCases\Base\LoadRecordById;
use App\Http\Database\Contracts\IUserRepository;

class LoadUserById extends LoadRecordById
{
    public function __construct(
        readonly IUserRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
