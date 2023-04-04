<x-app>
    <div class="pt-lg-5 d-flex align-items-center">
        <div class="container-sm d-flex flex-column w-75">
            <div>
                <h1 class="text-smoke">Add Country</h1>
            </div>
            <form action="{{url('/country')}}" method="POST">
                @csrf
                <div class="form-outline mb-5">
                    <input type="text" id="name" name="name" class="form-control"/>
                    <label class="form-label" for="name">Country Name</label>
                    <span class="form-helper">make sure the country is not registered</span>
                </div>

                <div class="form-outline mb-4">
                    <input type="text" id="code" name="code" class="form-control"/>
                    <label class="form-label" for="code">Country code</label>
                </div>

                <div class="d-flex align-items-center justify-content-around" role="group"
                     aria-label="Basic example">
                    <button type="submit" class="btn btn-black" style="width: 15%">Send</button>
                    <a href="{{ url('/countries') }}" class="btn btn-danger" style="width: 15%">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app>
