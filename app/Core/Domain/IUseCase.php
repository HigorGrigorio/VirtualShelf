<?php

namespace App\Core\Domain;

use App\Core\Logic\Result;

/**
 * A base interface for services.
 */
interface IUseCase
{
    public function execute($data): Result;
}
