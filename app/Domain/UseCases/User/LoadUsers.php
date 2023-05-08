<?php

namespace App\Domain\UseCases\User;

use App\Domain\UseCases\Base\LoadRecords;
use App\Presentation\Contracts\IUserRepository;

class LoadUsers extends LoadRecords
{
    public function __construct(
        readonly IUserRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
