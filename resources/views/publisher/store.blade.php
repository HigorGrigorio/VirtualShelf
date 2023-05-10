@extends('layouts.app')

@section('content')
    <div class="pt-lg-5 d-flex align-items-center">
        <div class="container-sm d-flex flex-column w-75">
            <div>
                <h1 class="text-smoke">Inserting Publishing</h1>
            </div>
            <form action="{{ route('tables.publishing.store') }}" method="POST">
                @csrf

                <x-input type="text" id="name " name="name" label="State Name"
                         help="Make sure the publishing is not registered"/>

                <x-input type="text" id="email " name="email" label="State Email"
                         help="The email must be unique"/>

                <label class="form-label">Select a State</label>
                <!--State select-->
                <select name="state_id" class="form-select  @error('state_id') is-invalid @enderror"
                        aria-label="Country of State">
                    @foreach($states as $state)
                        <option
                            value="{{$state['id']}}">{{ $state['name'] }}</option>
                    @endforeach
                </select>

                @error('state_id')
                    <span class="form-text text-danger">
                        {{$message}}
                    </span>
                @enderror

                <div class="d-flex align-items-center justify-content-around mt-4" role="group"
                     aria-label="Basic example">
                    <button type="submit" class="btn btn-ocean" style="width: 15%">Send</button>
                    <a href="{{ route('tables.publishing.index') }}" class="btn btn-danger" style="width: 15%">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
