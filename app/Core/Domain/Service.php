<?php

namespace App\Core\Domain;

use App\Core\Logic\Result;

/**
 * A base interface for services.
 */
interface Service
{
    public function execute($request = null): Result;
}
