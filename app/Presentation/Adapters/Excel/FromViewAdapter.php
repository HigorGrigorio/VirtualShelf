<?php

namespace App\Presentation\Adapters\Excel;

use App\Core\Infra\Traits\Adapter;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View as ViewFactory;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use RuntimeException;


class FromViewAdapter implements FromView
{
    use Adapter;

    public function __construct(
        private readonly string $view,
        private readonly array  $config,
    )
    {
    }

    protected function attributes(): array
    {
        if(!isset($this->config['attributes'])) {
            throw new RuntimeException('Attributes not found in config');
        }

        return $this->config['attributes'];
    }

    protected function collection(): Collection
    {
        if(!isset($this->config['collection'])) {
            throw new RuntimeException('Collection not found in config');
        }

        return $this->config['collection'];
    }

    protected function columns(): array
    {
        if(!isset($this->config['columns'])) {
            throw new RuntimeException('Columns not found in config');
        }

        return $this->config['columns'];
    }

    protected function title(): string
    {
        if(!isset($this->config['title'])) {
            throw new RuntimeException('Title not found in config');
        }

        return $this->config['title'];
    }

    public function view(): View
    {
        return ViewFactory::make($this->view, [
            'collection' => $this->collection(),
            'columns'    => $this->columns(),
            'title'      => $this->title(),
            'attributes' => $this->attributes(),
        ]);
    }
}
