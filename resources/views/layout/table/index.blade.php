<x-app :tables="$tables" :table="$singular">
    <x-modal-confirm/>
    <div class="container px-0">
        <div class="pt-4 pb-3 container-fluid d-flex flex-row justify-content-between px-0">
            <div>
                <a href="{{ route('tables.' . $singular . '.create') }}" class="btn btn-dark">
                    <i class="fas fa-plus"></i>
                    <span class="ms-2">Add</span>
                </a>
            </div>
            <form action="{{route($index)}}" method="get"
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
            <x-table :pagination="$pagination" :columns="$columns"/>
        @else
            <div class="alert alert-danger">
                There is no data to show
            </div>
        @endif
    </div>
</x-app>
