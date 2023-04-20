<?php

namespace App\Domain\UseCases\User;

use App\Domain\UseCases\Base\LoadRecords;
use App\Presentation\Interfaces\IUserRepository;

class LoadUsers extends LoadRecords
{
    public function __construct(
        readonly IUserRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
