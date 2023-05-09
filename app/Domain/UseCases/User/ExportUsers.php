<?php

namespace App\Domain\UseCases\User;

use App\Domain\UseCases\Base\ExportRecord;
use App\Http\Database\Contracts\IUserRepository;

class ExportUsers extends ExportRecord
{
    public function __construct(
        readonly IUserRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
