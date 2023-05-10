@extends('layouts.app')

@section('content')
    <div class="pt-lg-5 d-flex align-items-center">
        <div class="container-sm d-flex flex-column w-75">
            <div class="pb-4">
                <h1>Editing state @if(isset($record))
                        {{$record->name}} ({{$record->country->name}})
                    @endif.</h1>
            </div>
            <form action="{{route('tables.state.update', $record->id)}}" method="POST">
                @csrf

                <x-input type="text"
                         id="name"
                         name="name"
                         label="Language"
                         help="if you change a name, the state will be registered as a new one"
                         :value="isset($record) ? $record->name : null"/>

                <label class="form-label">Select a Country</label>
                <!--Country select-->
                <select name="country_id" class="form-select" aria-label="Country of State">
                    @foreach($countries as $country)
                        <option
                        value="{{$country['id']}}" {{$country['id'] === $record['country_id'] ? 'selected' : ''}}>{{ $country['name'] }}</option>
                    @endforeach
                </select>

                <div class="d-flex align-items-center justify-content-around mt-5" role="group"
                     aria-label="Basic example">
                    <button type="submit" class="btn btn-ocean" style="width: 15%">Send</button>
                    <a href="{{ route('tables.country.index') }}" class="btn btn-danger" style="width: 15%">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
