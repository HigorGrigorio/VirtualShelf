<?php

namespace App\Domain\UseCases\Base;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\UseCase;
use App\Http\Database\Contracts\Repository;
use Illuminate\Support\Facades\Config;
use Throwable;

class PaginateRecords extends UseCase
{
    public function __construct(
        Repository $repository
    )
    {
        parent::__construct($repository);
    }

    public function execute(): Result
    {
        try {
            $data = $this->getArgs();

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
                $this->getRepository()->paginate(
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
