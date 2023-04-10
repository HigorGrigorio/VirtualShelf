<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;

class AuthorController extends Controller
{
    public function __construct(
        private \App\Domain\UseCases\Author\LoadAuthors $loadAuthors
    )
    {
    }

    public function index(Request $request)
    {
        $options = $request->all();

        $result = $this->loadAuthors->execute($options);

        if ($result->isRejected()) {
            $this->danger($result->getMessage());
            $view = view('pages.author.index');
        } else {
            if (count($result->get()) == 0) {
                $this->info('No authors found');
            }

            $data = $result->get();
            $paginator = null;

            if($data instanceof LengthAwarePaginator) {
                $paginator = $data;
                $data = $data->toArray();
            }

            $view = view('pages.author.index')->with([
                'collection' => $data,
                'paginator' => $paginator,
            ]);
        }

        $view->with([
            'search' => $options['search'] ?? '',
            'limit' => $options['limit'] ?? Config::get('app.pagination.per_page'),
            'page' => $options['page'] ?? 1,
        ]);

        return $view;
    }

}
