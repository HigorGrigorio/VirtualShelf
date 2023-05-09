<?php

namespace App\Presentation\Adapters\Excel;

use App\Core\Infra\Traits\Adapter;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class FromCollectionAdapter implements FromCollection
{
    use Adapter;

    public function __construct(private readonly Collection $collection)
    {
    }

    public function collection(): Collection
    {
        return $this->collection;
    }
}
