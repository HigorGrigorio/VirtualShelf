<x-app>
    <div class="container px-0">
        <div class="pt-4 pb-3 container-fluid d-flex flex-row justify-content-between px-0">
            <div>
                <a href="{{route('tables.author.create')}}" class="btn btn-dark">
                    <i class="fas fa-plus"></i>
                    <span class="ms-2">Add</span>
                </a>
            </div>
            <form action="{{route('tables.country.index')}}" method="get" class="d-flex flex-row w-75 gap-3 align-items-center">
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
        <x-table :pagination="$pagination" :columns="[
            'id' => '#',
            'name' => 'Name',
            'surname' => 'Surname',
            'actions' => [
                'label' => 'Actions',
                'edit' => [
                    'route' => 'tables.author.edit',
                    'params' => ['id' => 'id']
                ],
                'delete' => [
                    'route' => 'tables.author.destroy',
                    'params' => ['id' => 'id'],
                ]
            ]
        ]"/>
    </div>
</x-app>
