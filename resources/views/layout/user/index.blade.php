<x-app :table="$table" :tables="$tables">
    <div class="container px-0">
        <div class="pt-4 pb-3 container-fluid d-flex flex-row justify-content-between px-0">
            <div>
                <a href="{{route('tables.user.create')}}" class="btn btn-dark">
                    <i class="fas fa-plus"></i>
                    <span class="ms-2">Add</span>
                </a>
            </div>
            <form action="{{route('tables.user.index')}}" method="get"
                  class="d-flex flex-row w-75 gap-3 align-items-center">
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
        @if(isset($pagination))
            <x-modal-delete/>
            <div class="d-block scrollable-y table-bordered" style="height: calc(100vh - 220px)">
                <table class="table table-sm align-middle mb-0 bg-white">
                    <thead style="  position: sticky;
                                 background: var(--bs-gray-200);
                                 top: 0;
                                 z-index: 100;">
                    <tr class="text-dark">
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pagination as $row)
                        <tr>
                            <th scope="row">{{$row->id}}</th>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div>
                                        <img src="{{url($row->photo ?? 'images/default-photo.jpg')}}"
                                             class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{$row->name}}</h6>
                                        <p class="text-xs text-secondary mb-0">{{$row->email}}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('tables.user.edit', ['id' => $row->id]) }}"
                                   role="button"
                                   class="btn btn-link btn-rounded btn-sm fw-bold"
                                   data-mdb-ripple-color="dark">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button
                                    data-href="{{ route('tables.user.destroy', ['id' => $row->id]) }}"
                                    data-mdb-toggle="modal"
                                    data-mdb-target="#confirm-modal"
                                    class="btn btn-link btn-rounded btn-sm fw-bold">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <a href="{{ route('tables.user.show', ['id' => $row->id]) }}"
                                   role="button"
                                   class="btn btn-link btn-rounded btn-sm fw-bold"
                                   data-mdb-ripple-color="dark">
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
</x-app>
