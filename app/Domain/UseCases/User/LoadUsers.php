<?php

namespace App\Domain\UseCases\User;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\Record\LoadRecords;
use App\Interfaces\IAuthorRepository;
use App\Interfaces\IUserRepository;
use Illuminate\Support\Facades\Config;

class LoadUsers extends LoadRecords
{
    public function __construct(
        readonly IUserRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
