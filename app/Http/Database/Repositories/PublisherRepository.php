<?php

namespace App\Http\Database\Repositories;

use App\Core\Logic\Maybe;
use App\Http\Database\Contracts\PublisherRepository as RepositoryContract;
use App\Models\Publisher;

class PublisherRepository extends Repository implements RepositoryContract
{
    use Traits\CreateRepository,
        Traits\DeleteById,
        Traits\DeleteRepository,
        Traits\ExportRepository,
        Traits\GetAllRepository,
        Traits\GetByIdRepository,
        Traits\PaginateRepository,
        Traits\UpdateByIdRepository,
        Traits\UpdateRepository;

    public function __construct(
        readonly Publisher $dao
    )
    {
        parent::__construct($dao);
    }

    public function relations(): array
    {
        return ['state'];
    }

    public function getPublisherByName(string $name): Maybe
    {
        return $this->getBy('name', $name);
    }

    public function getPublisherByEmail(string $code): Maybe
    {
        return $this->getBy('email', $code);
    }
}
