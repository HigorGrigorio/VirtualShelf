<?php

namespace App\Domain\UseCases\Country;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\Base\LoadRecords;
use App\Presentation\Interfaces\ICountryRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;

class LoadCountries extends LoadRecords
{
    public function __construct(readonly ICountryRepository $countryRepository)
    {
    }

    /**
     * @param $options
     *
     * @return Result<LengthAwarePaginator>
     */
    public function execute($options): Result
    {
        try {
            $search = $options['search'] ?? null;


            $page = $options['page'] ?? 1;
            $limit = $options['limit'] ?? Config::get('app.pagination.per_page');

            $authors = $this->countryRepository->paginate($page, $search, $limit);

            if (!$authors->count()) {
                $result = Result::reject(Maybe::flat($authors), 'Countries not found');
            } else {
                $result = Result::accept(Maybe::flat($authors), 'Countries loaded successfully');
            }
        } catch (\Exception $e) {
            $result = Result::reject(Maybe::just([]), $e->getMessage());
        }

        return $result;
    }
}
