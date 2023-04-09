<?php

namespace App\Http\Database\Repositories;

class AuthorRepository implements \App\Interfaces\IAuthorRepository
{
    public function __construct(
        private readonly \App\Models\Author $dao
    )
    {
    }

    public function getAll(): array {
        return [];
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

    public function getAuthorById(int $id): array
    {
        // TODO: Implement getAuthorById() method.
    }

    public function getAuthorByName(string $name): array
    {
        // TODO: Implement getAuthorByName() method.
    }

    public function getAuthorBySurname(string $surname): array
    {
        // TODO: Implement getAuthorBySurname() method.
    }

    public function create(array $data): int
    {
        // TODO: Implement create() method.
    }

    public function update(int $id, array $data): bool
    {
        // TODO: Implement update() method.
    }

    public function delete(array $columns): int
    {
        // TODO: Implement delete() method.
    }
}
