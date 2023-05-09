<?php

namespace App\Domain\UseCases\User;

use App\Domain\UseCases\Base\ExportRecord;
use App\Http\Database\Contracts\UserRepository;

class ExportUsers extends ExportRecord
{
    public function __construct(
        readonly UserRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
