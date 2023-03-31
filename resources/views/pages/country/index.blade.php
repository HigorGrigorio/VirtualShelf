<x-app>
    <div class="container-fluid overflow-scroll-y-smoke">
        <div class="pt-4 pb-3  container-fluid  d-flex flex-row justify-content-between">
            <a href="#" class="fs-6 btn-group text-smoke text-decoration-none">
                <i class="btn btn-outline-smoke ph-bold ph-plus active"></i>
                <span class="btn btn-outline-smoke">Add Country</span>
            </a>
            <form action="{{request()->fullUrl()}}" method="get" class="d-flex flex-row w-75 gap-3 align-items-center">
                <label for="limit" class="text-smoke">Quantity: </label>
                <select name="limit" id="limit" class="form-select w-auto input-smoke" aria-label="10">
                    <option value="10" selected>10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <div class="input-group">
                    <input name="search" type="text" class="form-control input-smoke" placeholder="Search here..."
                           aria-label="Search here..."
                           aria-describedby="button-addon2">
                    <button class="btn btn-outline-smoke" type="submit" id="button-addon2">Search</button>
                </div>
            </form>
        </div>
        @if($collection)
            <table class="table-bordered table table-hover rounded-3 primary-shadow">
                <thead>
                <tr>
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
                            <a href="#" class="link-dark">Edit</a>
                            <a href="#" class="link-dark">Remove</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $collection->links() }}
        @else
            <div class="alert alert-danger">
                There is no data to show
            </div>
        @endif
    </div>
</x-app>
