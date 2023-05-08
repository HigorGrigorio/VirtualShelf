<?php

namespace App\Domain\UseCases\User;

use App\Domain\UseCases\Base\LoadRecordById;
use App\Presentation\Contracts\IUserRepository;

class LoadUserById extends LoadRecordById
{
    public function __construct(
        readonly IUserRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
