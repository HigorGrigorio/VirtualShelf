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
            dd($result);
        } else {
            $view = view('pages.author.index')->with([
                'pagination' => $result->get(),
            ]);
        }

        $view->with([
            'search' => $options['search'] ?? '',
            'limit' => $options['limit'] ?? Config::get('app.pagination.per_page'),
            'limits' => Config::get('app.pagination.limits'),
        ]);

        return $view;
    }

}
