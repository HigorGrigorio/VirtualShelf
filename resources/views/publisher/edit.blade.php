@extends('layouts.app', ['title' => `Editing ` . $record[`name`]])

@section('content')
    <div class="pt-lg-5 d-flex align-items-center">
        <div class="container-sm d-flex flex-column w-75">
            <div class="pb-4">
                <h1>Editing publisher @if(isset($record))
                        {{$record->name}} ({{$record->state->name}})
                    @endif.</h1>
            </div>
            <form action="{{route('tables.'.$singular.'.update', $record->id)}}" method="POST">
                @csrf

                <x-input type="text"
                         id="name"
                         name="name"
                         label="Name"
                         help="if you change a name, the publisher name will be registered as a new one"
                         :value="isset($record) ? $record->name : null"/>

                <x-input type="text"
                         id="email"
                         name="email"
                         label="Email"
                         help="must be unique"
                         :value="isset($record) ? $record->email : null"/>


                <label class="form-label">Select a State</label>
                <!--State select-->
                <select name="state_id" class="form-select  @error('state_id') is-invalid @enderror"
                        aria-label="Country of State">
                    @foreach($states as $state)
                        <option
                            value="{{$state['id']}}" {{$state['id'] === $record['state_id'] ? 'selected' : ''}}>{{ $state['name'] }}</option>
                    @endforeach
                </select>

                @error('state_id')
                    <span class="form-text text-danger">
                        {{$message}}
                    </span>
                @enderror

                <div class="d-flex align-items-center justify-content-around mt-5" role="group"
                     aria-label="Basic example">
                    <button type="submit" class="btn btn-ocean" style="width: 15%">Send</button>
                    <a href="{{ route('tables.'.$singular.'.index') }}" class="btn btn-danger" style="width: 15%">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
