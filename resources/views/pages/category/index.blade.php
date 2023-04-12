<x-app>
    <x-modal-confirm/>
    <div class="container px-0">
        <div class="pt-4 pb-3 container-fluid d-flex flex-row justify-content-between px-0">
            <div>
                <a href="{{route('tables.category.create')}}" class="btn btn-dark">
                    <i class="fas fa-plus"></i>
                    <span class="ms-2">Add</span>
                </a>
            </div>
            <form action="{{route('tables.category.index')}}" method="get"
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
        <?php $make_icon = function ($item): string {
            return '<img src="' . $item->icon . '" alt="icon" style="width: 35px; object-fit: cover;">';
        } ?>
        @if(isset($pagination))
            <x-table :pagination=" $pagination" :columns="[
                'id' => '#',
                'name' => 'Name',
                'slug' => 'slug',
                'description' => 'Description',
                'actions' => [
                    'label' => 'Actions',
                    'edit' => [
                        'route' => 'tables.category.edit',
                        'params' => ['id' => 'id']
                    ],
                    'delete' => [
                        'route' => 'tables.category.destroy',
                        'params' => ['id' => 'id']
                    ]
                ]
            ]"/>
        @else
            <div class="alert alert-danger">
                There is no data to show
            </div>
        @endif
    </div>
</x-app>
