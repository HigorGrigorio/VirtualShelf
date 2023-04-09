<?php

namespace App\Http\Database\Repositories;

use App\Core\Logic\Maybe;
use App\Interfaces\IRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class Repository implements IRepository
{
    public function __construct(
        private readonly Model $dao
    )
    {
    }

    public function create(array $data): array
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
        return $this->dao->all()->toArray();
    }

    public function getBy(string $column, string $value): Maybe
    {
        return Maybe::flat($this->dao->where($column, $value)->first());
    }

    public function getById($id): Maybe
    {
        return Maybe::flat($this->dao->find($id));
    }

    private function getSearchQuery(string $search, array $searchable): \Closure
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
        if (is_null($searchable)) {
            $searchable = $this->getSearchable();
        } else {
            $searchable = array_merge(
                $this->getSearchable(),
                $searchable
            );
        }

        return $this->dao
            ->where($this->getSearchQuery($search, $searchable))
            ->paginate($limit);
    }

    public function update(array $data, array $columns): int
    {
        $models = $this->dao->where($columns)->get();
        $affectedRows = 0;

        if ($models) {
            for ($i = 0; $i < count($models); $i++) {
                $affectedRows += $models[$i]->update($data);
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

    public function getDao(): Model
    {
        return $this->dao;
    }
}
