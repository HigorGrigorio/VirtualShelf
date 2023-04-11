<x-app>
    <div class="pt-lg-5 d-flex align-items-center">
        <div class="container-sm d-flex flex-column w-75">
            <div class="pb-4">
                <h1>Editing country @if(isset($model))
                        {{$model['name']}} {{$model['surname']}}
                    @endif.</h1>
            </div>
            <form action="{{url('table/author/update/' . $model['id'])}}" method="POST">
                @csrf

                <x-input-group type="text"
                               id="name"
                               name="name"
                               label="Author Name"
                               help="if you change a name, the first name of author will be registered as a new one"
                               :value="isset($model) ? $model['name'] : null"/>

                <x-input-group type="text"
                               id="surname"
                               name="surname"
                               label="Author surname"
                               :value="isset($model) ? $model['surname'] : null"/>

                <div class="d-flex align-items-center justify-content-around" role="group"
                     aria-label="Basic example">
                    <button type="submit" class="btn btn-dark" style="width: 15%">Send</button>
                    <a href="{{ url('table/authors') }}" class="btn btn-danger" style="width: 15%">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app>