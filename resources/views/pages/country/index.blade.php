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
        <?php $make_icon = function ($item): string {
            return '<img src="' . $item->icon . '" alt="icon" style="width: 35px; object-fit: cover;">';
        } ?>
        <x-table :pagination="$pagination ?? null" :columns="[
            'id' => '#',
            'icon' => [
                    'label' => 'Icon',
                    'value' => $make_icon,
                    ],
            'name' => 'Name',
            'code' => 'Code',
            'actions' => [
                'label' => 'Actions',
                'edit' => [
                    'route' => 'pages.country.edit',
                    'params' => ['id' => 'id']
                ],
                'delete' => [
                    'route' => 'pages.country.destroy',
                    'params' => ['id' => 'id']
                ]
            ]
        ]"/>
    </div>
</x-app>
