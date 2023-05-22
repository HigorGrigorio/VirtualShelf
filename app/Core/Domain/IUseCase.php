<?php

namespace App\Core\Domain;

use App\Core\Logic\Result;

/**
 * A base interface for services.
 */
interface IUseCase
{
    public function execute(): Result;

    public function getArgs(): array;

    public function setArgs(array $args): IUseCase;
}
