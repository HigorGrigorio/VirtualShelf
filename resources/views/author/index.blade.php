@extends('layouts.app', ['title' => 'Authors'])

@section('content')
    <div class="container px-0">
        <div class="pt-4 pb-3 container-fluid d-flex flex-row justify-content-between px-0">
            <div>
                <a href="{{route('tables.author.create')}}" class="btn btn-ocean">
                    <i class="fas fa-plus"></i>
                    <span class="ms-2">Add</span>
                </a>
                <!-- dropdown export -->
                @include(
                    'layouts.partials.dropdown-export',
                    ['table' => 'author']
                )
            </div>
            <form action="{{route('tables.author.index')}}" method="get"
                  class="d-flex flex-row w-75 gap-3 align-items-center">
                <div class="input-group">
                    <select name="limit" class="form-select " aria-label="Limit of exhibition..." style="width: 5rem">
                        @foreach($limits as $op)
                            <option value="{{$op}}" {{ $op == $limit ? 'selected' : '' }}>{{$op}}</option>
                        @endforeach
                    </select>
                    <div class="form-outline">
                        <input type="search" id="search" name="search" class="form-control" value="{{ $search ?? ''}}"/>
                        <label class="form-label" for="search">Search</label>
                    </div>
                    <button type="submit" class="btn btn-ocean">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        @if(isset($pagination))
            <x-modal-delete/>
            <div class="d-block scrollable-y table-bordered" style="height: calc(100vh - 220px)">
                <table class="table align-middle mb-0 bg-white">
                    <thead style="  position: sticky;
                                 background: var(--bs-gray-200);
                                 top: 0;
                                 z-index: 100;">
                    <tr class="text-black">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Surname</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pagination as $row)
                        <tr>
                            <th scope="row">{{ $row->id }}</th>
                            <th>{{ $row->name }}</th>
                            <th>{{ $row->surname }}</th>
                            <td>
                                <a href="{{ route('tables.author.edit', ['id' => $row->id]) }}"
                                   role="button"
                                   class="btn btn-link text-warning btn-rounded btn-sm fw-bold"
                                   data-mdb-ripple-color="primary">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button
                                    data-href="{{ route('tables.author.destroy', ['id' => $row->id]) }}"
                                    data-mdb-toggle="modal"
                                    data-mdb-target="#confirm-modal"
                                    class="btn btn-link text-danger btn-rounded btn-sm fw-bold">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <a href="{{ route('tables.author.show', ['id' => $row->id]) }}"
                                   role="button"
                                   class="btn btn-link text-success btn-rounded btn-sm fw-bold"
                                   data-mdb-ripple-color="primary">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-1">
                {{ $pagination->links() }}
            </div>
        @else
            <h3>There is no data to show</h3>
        @endif
    </div>
@endsection
