<?php

namespace App\Domain\UseCases\User;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\Base\CreateRecord;
use App\Interfaces\IUserRepository;

class CreateUser extends CreateRecord
{
    public function __construct(
        readonly IUserRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
