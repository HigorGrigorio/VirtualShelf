<x-app :table="$table" :tables="$tables">
    <div class="pt-lg-5 d-flex align-items-center">
        <div class="container-sm d-flex flex-column w-75">
            <div class="pb-4">
                <h1>Editing category @if(isset($record))
                        {{$record['name']}}
                    @endif.</h1>
            </div>
            <form action="{{url('tables/category/update/' . $record['id'])}}" method="POST">
                @csrf

                <x-input type="text" id="name " name="name" label="Category Name"
                         help="make sure the category is not registered"
                         :value="isset($record) ? $record['name'] : null"/>

                <x-input type="text" id="slug" name="slug" label="Category Slug"
                         help="The slug must be unique" :value="isset($record) ? $record['slug'] : null"/>

                <x-text-area type="text" id="description" name="description" label="Category Description" rows="4"
                             :value="isset($record) ? $record['description'] : null"/>

                <div class="d-flex align-items-center justify-content-around" role="group"
                     aria-label="Basic example">
                    <button type="submit" class="btn btn-ocean" style="width: 15%">Send</button>
                    <a href="{{ route('tables.country.index') }}" class="btn btn-danger" style="width: 15%">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app>
