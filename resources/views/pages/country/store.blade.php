<x-app>
    <div class="pt-lg-5 d-flex align-items-center">
        <div class="container-sm d-flex flex-column w-75">
            <div>
                <h1 class="text-smoke">Add Country</h1>
            </div>
            <form action="{{url('/country')}}" method="POST">
                @csrf

                <x-input-group type="text" id="name " name="name" label="Country Name"
                               help="make sure the country is not registered"/>

                <x-input-group type="text" id="code" name="code" label="Country Code"
                               placeholder="Tap a country code here..."/>

                <div class="d-flex align-items-center justify-content-around" role="group"
                     aria-label="Basic example">
                    <button type="submit" class="btn btn-black" style="width: 15%">Send</button>
                    <a href="{{ url('/countries') }}" class="btn btn-danger" style="width: 15%">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app>
