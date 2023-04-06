<x-app>
    <div class="pt-lg-5 d-flex align-items-center">
        <div class="container-sm d-flex flex-column w-75 h-100">
            <h2>Are you sure you want to remove the country @if(isset($model))
                    {{$model['name']}} ({{$model['code']}})
                @endif ?</h2>
            <form action="{{url('/country/destroy/'. $model['id']) }}" method="POST">
                @csrf
                <div class="d-flex align-items-center justify-content-around mt-5" role="group"
                     aria-label="Options">
                    <button type="submit" class="btn btn-black"
                            style="width: 15%">Remove
                    </button>
                    <a href="{{ url('/table/countries') }}" class="btn btn-danger" style="width: 15%">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app>
