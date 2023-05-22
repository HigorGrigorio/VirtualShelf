<?php

namespace App\Http\Database\Repositories\Traits;

use App\Http\Database\Repositories\Repository;
use Closure;
use Illuminate\Pagination\LengthAwarePaginator;

trait PaginateRepository
{
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
        return $this->getDao()->getFillable();
    }
    public function paginate(int $page, string $search = null, $limit = null, array $searchable = null): LengthAwarePaginator
    {
        $table = $this->getDao();

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
}
