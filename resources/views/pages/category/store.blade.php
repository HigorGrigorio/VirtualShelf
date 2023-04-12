<x-app>
    <div class="pt-lg-5 d-flex align-items-center">
        <div class="container-sm d-flex flex-column w-75">
            <div>
                <h1 class="text-smoke">Inserting Category</h1>
            </div>
            <form action="{{ route('tables.category.store') }}" method="POST">
                @csrf

                <x-input type="text" :id="'name'" name="name" label="Category Name"
                         help="make sure the category is not registered"/>

                <x-input type="text" :id="'slug'" name="slug" label="Category Slug"
                         help="The slug must be unique"/>

                <x-text-area type="text" id="description" name="description" label="Category Description" rows="4"
                        help="The max of characters is 512."/>

                <div class="d-flex align-items-center justify-content-around" role="group"
                     aria-label="Basic example">
                    <button type="submit" class="btn btn-dark" style="width: 15%">Send</button>
                    <a href="{{ route('tables.category.index') }}" class="btn btn-danger" style="width: 15%">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app>
