<x-app>
    <div class="pt-lg-5 d-flex align-items-center">
        <div class="container-sm d-flex flex-column w-75">
            <div class="pb-4">
                <h1>Editing language @if(isset($model))
                        {{$model['name']}} ({{$model['acronym']}})
                    @endif.</h1>
            </div>
            <form action="{{url('tables/language/update/' . $model['id'])}}" method="POST">
                @csrf

                <x-input-group type="text"
                               id="name"
                               name="name"
                               label="Language"
                               help="if you change a name, the language will be registered as a new one"
                               :value="isset($model) ? $model['name'] : null"/>

                <x-input-group type="text"
                               id="acronym"
                               name="acronym"
                               label="Language Acronym"
                               help="The acronym language must be 2 characters long in accordance with ISO 639-1:2002"
                               :value="isset($model) ? $model['acronym'] : null"/>

                <div class="d-flex align-items-center justify-content-around" role="group"
                     aria-label="Basic example">
                    <button type="submit" class="btn btn-dark" style="width: 15%">Send</button>
                    <a href="{{ route('tables.country.index') }}" class="btn btn-danger" style="width: 15%">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app>
