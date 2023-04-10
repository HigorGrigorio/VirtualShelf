@if(isset($pagination))
    <div class="d-block scrollable-y table-bordered" style="height: calc(100vh - 220px)">
        <table class="table align-middle mb-0 bg-white">
            <thead
                style="  position: sticky;
                                 background: var(--bs-gray-200);
                                 top: 0;
                                 z-index: 100;">
            <tr class="text-dark">
                @foreach($columns as $key => $column)
                    <th scope="col">{{($key == 'actions' ? 'Actions' : $column)}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($pagination as $item)
                <tr>
                    @foreach($columns as $key => $column)
                        @if($key == 'id')
                            <th scope="row">{{$item[$key]}}</th>
                        @elseif($key == 'actions')
                            <td>
                                @foreach($column as $key_option => $option)
                                    @if($key_option == 'edit')
                                        <a href="{{ route($option['route'], $option['params']) }}"
                                           role="button"
                                           class="btn btn-link btn-rounded btn-sm fw-bold"
                                           data-mdb-ripple-color="dark">
                                            edit
                                        </a>
                                    @elseif($key_option == 'delete')
                                        <button data-href="{{ route($option['route'], $option['params']) }}"
                                                data-mdb-toggle="modal"
                                                data-mdb-target="#confirm-modal"
                                                class="btn btn-link btn-rounded btn-sm fw-bold">
                                            delete
                                        </button>
                                    @endif
                                @endforeach
                            </td>
                        @else
                            <th>{{$item[$key]}}</th>
                        @endif
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-2">
        {{ $pagination->links() }}
    </div>
@else
    <div class="alert alert-danger">
        There is no data to show
    </div>
@endif
