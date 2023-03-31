<?php

namespace App\Http\Database\Repositories;

use App\Core\Logic\Maybe;
use App\Interfaces\ICountryRepository;
use App\Models\Country;
use Illuminate\Pagination\LengthAwarePaginator;

class CountryRepository implements ICountryRepository
{
    public function __construct(
        private readonly Country $country
    )
    {
    }

    public function getAll($options): LengthAwarePaginator
    {
        $offset = ($options['page'] - 1) * $options['limit'];
        $builder = $this->country
            ->where(function ($query) use ($options) {
                if (isset($options['search'])) {
                    $query->where('name', 'like', "%{$options['search']}%");
                    $query->orWhere('code', 'like', "%{$options['search']}%");
                }
            })
            ->offset($offset)
            ->limit($options['limit']);

        return $builder->paginate($options['limit']);
    }

    public function findById(int $id): Maybe
    {
        return Maybe::flat($this->country->find($id));
    }

    public function create(array $data): int
    {
        return $this->country->create($data)->id;
    }

    public function update(int $id, array $data): bool
    {
        $user = $this->country->find($id);

        if ($user) {
            $user->update($data);
            return true;
        }

        return false;
    }

    public function delete(array $columns): int
    {
        $users = $this->country->all($columns);

        if ($users) {
            $c = count($users);

            foreach ($users as $user) {
                $user->delete();
            }

            return $c;
        }
        return 0;
    }
}
