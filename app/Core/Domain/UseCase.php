<?php

namespace App\Core\Domain;

use App\Core\Logic\Result;

/**
 * A base interface for services.
 */
interface UseCase
{
    public function execute($options): Result;
}
