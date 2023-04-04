<x-app>
    <div class="pt-lg-5 d-flex align-items-center">
        <div class="container-sm d-flex flex-column w-75">
            <div>
                <h1 class="text-smoke">Add Country</h1>
            </div>
            <form action="{{url('/country')}}" class="mt-3" method="POST">
                @csrf
                <x-input name="email" type="email" help="" placeHolder="" $ariaDescribedby="" />
                <div class="form-group mt-3">
                    <label for="code">Code</label>
                    <input type="text" name="code" class="form-control input-smoke" id="code" placeholder="Code">
                </div>
                <div class="container-sm d-flex justify-content-around pt-3">
                    <button type="submit" class="btn btn-primary btn-smoke">
                        Submit
                    </button>
                    <a href="{{url('/countries')}}" class="btn btn-outline-danger">
                        Back
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app>
