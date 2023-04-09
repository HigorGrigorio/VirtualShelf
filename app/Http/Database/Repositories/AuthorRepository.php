<?php

namespace App\Http\Database\Repositories;

use App\Core\Logic\Maybe;
use App\Models\Author;

class AuthorRepository implements \App\Interfaces\IAuthorRepository
{
    public function __construct(
        private readonly Author $dao
    )
    {
    }

    public function getAll(string $search): array
    {
        return $this->dao
            ->where(function ($query) use ($search) {
                if (isset($search)) {
                    $query->where('name', 'like', "%{$search}%");
                    $query->orWhere('surname', 'like', "%{$search}%");
                }
            })
            ->get();
    }

    public function paginate(int $page, string $search = null, int $limit = null): array
    {
        if (!isset($limit))
            $limit = config('app.pagination.limit', 10);

        $offset = ($page - 1) * $limit;

        $builder = $this->dao
            ->where(function ($query) use ($search) {
                if (isset($search)) {
                    $query->where('name', 'like', "%{$search}%");
                    $query->orWhere('surname', 'like', "%{$search}%");
                }
            })
            ->offset($offset)
            ->limit($limit);

        return $builder->paginate($limit);
    }

    public function getAuthorById(int $id): Maybe
    {
        return Maybe::flat($this->dao->find($id));
    }

    public function getAuthorByName(string $name): Maybe
    {
        return Maybe::flat($this->dao->where('name', $name)->first());
    }

    /**
     * @param string $surname
     *
     * @return Maybe<array<int,Author>>
     */
    public function getAuthorBySurname(string $surname): Maybe
    {
        return $this->dao->where('surname', $surname)->get();
    }

    public function create(array $data): int
    {
        return $this->dao->create($data)->id;
    }

    public function update(int $id, array $data): bool
    {
        return $this->dao->where('id', $id)->update($data);
    }

    public function delete(array $columns): int
    {
        return $this->dao->where($columns)->delete();
    }
}
