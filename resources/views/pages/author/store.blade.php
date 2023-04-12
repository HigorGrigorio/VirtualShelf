<x-app>
    <div class="pt-lg-5 d-flex align-items-center">
        <div class="container-sm d-flex flex-column w-75">
            <div>
                <h1 class="text-smoke">Inserting Author</h1>
            </div>
            <form action="{{route('tables.author.store')}}" method="POST">
                @csrf
                <x-input type="text" id="name " name="name" label="Author Name"
                               help="make sure the author name is not registered"/>

                <x-input type="text" id="surname" name="surname" label="Author Surname"/>

                <div class="d-flex align-items-center justify-content-around" role="group"
                     aria-label="Basic example">
                    <button type="submit" class="btn btn-dark" style="width: 15%">Send</button>
                    <a href="{{ route('tables.author.index') }}" class="btn btn-danger" style="width: 15%">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app>
