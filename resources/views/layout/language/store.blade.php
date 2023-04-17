<x-app :table="$table" :tables="$tables">
    <div class="pt-lg-5 d-flex align-items-center">
        <div class="container-sm d-flex flex-column w-75">
            <div>
                <h1 class="text-smoke">Inserting Language</h1>
            </div>
            <form action="{{ route('tables.language.store') }}" method="POST">
                @csrf

                <x-input type="text" id="name " name="name" label="Language"
                         help="make sure the language is not registered"/>

                <x-input type="text" id="acronym" name="acronym" label="Language Acronym"
                         help="The acronym language must be 2 characters long in accordance with ISO 639-1:2002"/>

                <div class="d-flex align-items-center justify-content-around" role="group"
                     aria-label="Basic example">
                    <button type="submit" class="btn btn-dark" style="width: 15%">Send</button>
                    <a href="{{ route('tables.language.index') }}" class="btn btn-danger" style="width: 15%">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app>
