<?php

namespace App\Domain\UseCases\Author;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\IAuthorRepository;
use Illuminate\Support\Facades\Config;

class LoadAuthors implements \App\Core\Domain\IUseCase
{
    public function __construct(
        private IAuthorRepository $authorRepository
    )
    {
    }

    public function execute($data): Result
    {
        try {
            $search = $data['search'] ?? null;


            $page = $data['page'] ?? 1;
            $limit = $data['limit'] ?? Config::get('app.pagination.per_page');

            $authors = $this->authorRepository->paginate($page, $search, $limit);

            if (!$authors->count()) {
                $result = Result::reject(Maybe::flat($authors), 'Authors not found');
            } else {
                $result = Result::accept(Maybe::flat($authors), 'Authors loaded successfully');
            }
        } catch (\Exception $e) {
            $result = Result::reject(Maybe::just([]), $e->getMessage());
        }

        return $result;
    }
}
