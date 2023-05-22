<?php

namespace App\Http\Database\Repositories;

use App\Core\Logic\Maybe;
use App\Http\Database\Contracts\Repository as Contract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements Contract
{
    public function __construct(
        private readonly Model $dao
    )
    {
    }

    /**
     * This method is used to define the default relations loaded with the query builder.
     * If you need to load more relations, you can override this method in the child class.
     *
     * @return array
     */
    public function relations(): array
    {
        return [];
    }

    protected function getQueryBuilderWithRelations(): Model|Builder
    {
        // the query builder to be returned.
        $queryBuilder = $this->getDao();

        // get relations
        $relations = $this->relations();

        return match (count($relations)) {
            0 => $queryBuilder,
            default => $queryBuilder->with($relations)
        };
    }


    public function getBy(string $column, string $value): Maybe
    {
        return Maybe::flat(
            $this
                ->getQueryBuilderWithRelations()
                ->where($column, $value)
                ->first()
        );
    }

    public function getDao(): Model
    {
        return $this->dao;
    }
}
