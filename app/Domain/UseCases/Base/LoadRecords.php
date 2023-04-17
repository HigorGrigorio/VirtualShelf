<?php

namespace App\Domain\UseCases\Base;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\IRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Config;
use Throwable;

class LoadRecords implements IUseCase
{
    public function __construct(
        private readonly IRepository $repository
    )
    {
    }

    public function execute($data): Result
    {
        try {
            if (!isset($data['page'])) {
                $data['page'] = Config::get('app.pagination.default_index_page');
            }

            if (!isset($data['limit'])) {
                $data['limit'] = Config::get('app.pagination.per_page');
            }

            if (!isset($data['search'])) {
                $data['search'] = '';
            }

            $pagination = Maybe::flat(
                $this->repository->paginate(
                    $data['page'],
                    $data['search'],
                    $data['limit']
                )
            );

            $result = Result::accept(
                $pagination,
                'Table loaded successfully'
            );
        } catch (Throwable $e) {
            $result = Result::from($e);
        }

        return $result;
    }
}
