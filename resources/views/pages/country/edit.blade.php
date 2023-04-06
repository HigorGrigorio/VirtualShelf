<x-app>
    <div class="pt-lg-5 d-flex align-items-center">
        <div class="container-sm d-flex flex-column w-75">
            <div class="pb-4">
                <h1 class="text-smoke">Editing country @if(isset($model))
                        {{$model['name']}} ({{$model['code']}})
                    @endif.</h1>
            </div>
            <form action="{{url('/country/update/' . $model['id'])}}" method="POST">
                @csrf

                <x-input-group type="text"
                               id="name"
                               name="name"
                               label="Country Name"
                               help="if you change a name, the country will be registered as a new one"
                               :value="isset($model) ? $model['name'] : null"/>

                <x-input-group type="text"
                               id="code"
                               name="code"
                               label="Country Code"
                               help="must contain a maximum of 3 characters and must be unique"
                               :value="isset($model) ? $model['code'] : null"/>

                <div class="d-flex align-items-center justify-content-around" role="group"
                     aria-label="Basic example">
                    <button type="submit" class="btn btn-black" style="width: 15%">Send</button>
                    <a href="{{ url('/countries') }}" class="btn btn-danger" style="width: 15%">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app>
