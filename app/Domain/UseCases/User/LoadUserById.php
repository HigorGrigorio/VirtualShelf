<?php

namespace App\Domain\UseCases\User;

use App\Domain\UseCases\Base\LoadRecordById;
use App\Http\Database\Contracts\UserRepository;

class LoadUserById extends LoadRecordById
{
    public function __construct(
        readonly UserRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
