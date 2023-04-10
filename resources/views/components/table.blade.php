@if(isset($pagination))
    <x-modal-confirm/>
    <div class="d-block scrollable-y table-bordered" style="height: calc(100vh - 220px)">
        <table class="table align-middle mb-0 bg-white">
            <thead
                style="  position: sticky;
                                 background: var(--bs-gray-200);
                                 top: 0;
                                 z-index: 100;">
            <tr class="text-dark">
                @foreach($columns as $key => $column)
                    <th scope="col">{{is_array($column) ? $column['label'] : $column}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($data as $row)
                <tr>
                    @foreach($row as $key => $column)
                            <th {{ $key == 'id' ? 'scope="row"' : '' }} >{!! $column !!}</th>
                    @endforeach
                    <td>
                        @foreach($actions as $key => $option)
                            @if($key == 'edit')
                                <a href="{{ route($option['route'], array_map(function($param) use($row) { return $row[$param]; }, $option['params'])) }}"
                                   role="button"
                                   class="btn btn-link btn-rounded btn-sm fw-bold"
                                   data-mdb-ripple-color="dark">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            @elseif($key == 'delete')
                                <button
                                    data-href="{{ route($option['route'], array_map(function($param) use($row) { return $row[$param]; }, $option['params'])) }}"
                                    data-mdb-toggle="modal"
                                    data-mdb-target="#confirm-modal"
                                    class="btn btn-link btn-rounded btn-sm fw-bold">
                                    <i class="fa fa-trash"></i>
                                </button>
                            @endif
                        @endforeach
                    </td>
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
