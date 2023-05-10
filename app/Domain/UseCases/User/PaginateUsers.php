<?php

namespace App\Domain\UseCases\User;

use App\Domain\UseCases\Base\PaginateRecords;
use App\Http\Database\Contracts\UserRepository;

class PaginateUsers extends PaginateRecords
{
    public function __construct(
        readonly UserRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
