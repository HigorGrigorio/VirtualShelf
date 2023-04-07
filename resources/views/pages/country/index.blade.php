<x-app>
    <x-modal-confirm/>
    <div class="container px-0">
        <div class="pt-4 pb-3 container-fluid d-flex flex-row justify-content-between px-0">
            <div>
                <a href="{{url('table/country/store')}}" class="btn btn-dark">
                    <i class="fas fa-plus"></i>
                    <span class="ms-2">Add</span>
                </a>
            </div>
            <form action="/table/countries" method="get" class="d-flex flex-row w-75 gap-3 align-items-center">
                <div>
                    <select name="limit" class="form-select" aria-label="Limit of exhibition..." style="width: 5rem">
                        @foreach($limits as $op)
                            <option value="{{$op}}" {{ $op == $limit ? 'selected' : '' }}>{{$op}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="form-outline">
                        <input type="search" id="search" name="search" class="form-control" value="{{ $search ?? ''}}"/>
                        <label class="form-label" for="search">Search</label>
                    </div>
                    <button type="submit" class="btn btn-dark">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
        @if(isset($collection))
            <div class="d-block scrollable-y table-bordered" style="height: calc(100vh - 220px)">
                <table class="table-bordered table-sm table table-hover">
                    <thead
                        style="  position: sticky;
                                 background: var(--bs-gray-200);
                                 top: 0;
                                 z-index: 100;">
                    <tr class="text-dark">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($collection as $item)
                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->code}}</td>
                            <td class="d-flex flex-row align-items-center justify-content-center gap-3">
                                <div class="btn-group">
                                    <a href="{{ url('table/country/edit/' . $item->id) }}"
                                       class="btn btn-info btn-sm">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                    <button data-href="{{url('table/country/delete/' . $item->id)}}"
                                            data-mdb-toggle="modal"
                                            data-mdb-target="#confirm-modal"
                                            class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
                {{ $collection->links() }}
            </div>
        @else
            <div class="alert alert-danger">
                There is no data to show
            </div>
        @endif
    </div>
</x-app>
