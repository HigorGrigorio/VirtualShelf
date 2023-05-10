<?php

namespace App\Http\Database\Repositories;

use App\Core\Logic\Maybe;
use App\Http\Database\Contracts\Repository as Contract;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class Repository implements Contract
{
    public function __construct(
        private readonly Model $dao
    )
    {
    }

    /**
     * Returns the relations of the model to be loaded in the query.
     *
     * @return array
     */
    protected function relations(): array
    {
        return [];
    }

    protected function getQueryBuilderWithRelations(): Model|Builder
    {
        // the query builder to be returned.
        $queryBuilder = $this->dao;

        // get relations
        $relations = $this->relations();

        return match (count($relations)) {
            0 => $queryBuilder,
            default => $queryBuilder->with($relations)
        };
    }

    public function create(array $data): Model
    {
        return $this->dao->create($data);
    }

    public function delete(array $columns): int
    {
        $models = $this->dao->where($columns)->get();
        $affectedRows = 0;

        if ($models) {
            for ($i = 0; $i < count($models); $i++) {
                $affectedRows += $models[$i]->delete();
            }
        }

        return $affectedRows;
    }

    public function deleteById(int $id): int
    {
        $model = $this->dao->where(['id' => $id])->first();
        $affectedRows = 0;

        if ($model) {
            $affectedRows = 1;
            $model->delete();
        }

        return $affectedRows;
    }

    public function getAll(): array
    {
        return $this
            ->getQueryBuilderWithRelations()
            ->all()
            ->toArray();
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

    public function getById($id): Maybe
    {
        return Maybe::flat(
            $this
                ->getQueryBuilderWithRelations()
                ->find($id)
        );
    }

    private function getSearchQueryAdapter(string|null $search, array $searchable): Closure
    {
        return function ($query) use ($searchable, $search) {
            if ($search) {
                for ($i = 0; $i < count($searchable); $i++) {
                    $query->orWhere($searchable[$i], 'like', "%{$search}%");
                }
            }
        };
    }

    private function getSearchable(): array
    {
        return $this->dao->getFillable();
    }

    public function paginate(int $page, string $search = null, $limit = null, array $searchable = null): LengthAwarePaginator
    {
        $table = $this->dao;

        if ($search) {
            $searchable = match ($searchable) {
                null => $this->getSearchable(),
                default => array_merge(
                    $this->getSearchable(),
                    $searchable
                ),
            };

            $table = $table->where($this->getSearchQueryAdapter($search, $searchable));
        }

        $relations = $this->relations();

        if (count($relations) > 0)
            $table = $table->with($relations);

        return $table->paginate($limit);
    }

    public function update(array $columns, array $data): int
    {
        $models = $this->dao->where($columns)->get();

        $affectedRows = 0;

        if ($models) {
            for ($i = 0; $i < count($models); $i++) {
                if ($models[$i]->update($data)) {
                    $models[$i]->save();
                    $affectedRows++;
                }
            }
        }

        return $affectedRows;
    }

    public function updateById(int $id, array $data): bool
    {
        $model = $this->dao->where(['id' => $id])->first();
        $updated = false;

        if ($model) {
            $model->update($data);
            $updated = true;
        }

        return $updated;
    }

    public function export(array $columns): Maybe
    {
        return Maybe::flat($this->dao->select($columns)->get(), ['array' => false]);
    }

    public function getDao(): Model
    {
        return $this->dao;
    }
}
