@extends('layouts.app')

@section('content')
    <div class="pt-lg-5 d-flex align-items-center">
        <div class="container-sm d-flex flex-column w-75">
            <div>
                <h1 class="text-smoke">Inserting State</h1>
            </div>
            <form action="{{ route('tables.state.store') }}" method="POST">
                @csrf

                <x-input type="text" id="name " name="name" label="State Name"
                         help="make sure the state is not registered"/>

                <label class="form-label">Select a Country</label>
                <!--Country select-->
                <select name="country_id" class="form-select" aria-label="Country of State">
                    <option selected></option>
                    @foreach($countries as $country)
                        <option value="{{$country['id']}}">{{ $country['name'] }}</option>
                    @endforeach
                </select>

                <div class="d-flex align-items-center justify-content-around mt-4" role="group"
                     aria-label="Basic example">
                    <button type="submit" class="btn btn-ocean" style="width: 15%">Send</button>
                    <a href="{{ route('tables.state.index') }}" class="btn btn-danger" style="width: 15%">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
