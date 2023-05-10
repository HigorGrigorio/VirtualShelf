<?php

namespace App\Http\Database\Contracts;

use App\Core\Logic\Maybe;

interface PublisherRepository extends Repository
{
    public function getPublisherByName(string $name): Maybe;

    public function getPublisherByEmail(string $code): Maybe;
}
