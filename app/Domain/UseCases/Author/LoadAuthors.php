<?php

namespace App\Domain\UseCases\Author;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\IAuthorRepository;
use Illuminate\Support\Facades\Config;

class LoadAuthors implements \App\Core\Domain\UseCase
{
    public function __construct(
        private IAuthorRepository $authorRepository
    ) {
    }

    public function execute($options): Result
    {
        $search = $options['search'] ?? null;

        if ($search == null) {
            $authors = $this->authorRepository->getAll();

            $flat = Maybe::flat($authors);

            if ($flat->isNothing()) {
                $result = Result::reject($flat,'Authors not found');
            } else {
                $result = Result::accept($flat, 'Authors loaded successfully');
            }
        } else {
            $page = $options['page'] ?? 1;
            $limit = $options['per_page'] ?? Config::get('app.pagination.per_page');

            $authors = $this->authorRepository->paginate($page, $search, $limit);

            if(!$authors->count()) {
                $result = Result::reject(Maybe::flat($authors), 'Authors not found');
            } else {
                $result = Result::accept(Maybe::flat($authors), 'Authors loaded successfully');
            }
        }

        return $result;
    }
}
