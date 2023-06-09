@extends('layouts.app', ['title' => 'Editing ' . $record->name])

@section('content')
    <div class="pt-lg-5 d-flex align-items-center">
        <div class="container-sm d-flex flex-column w-75">
            <div class="pb-4">
                <h1>Editing country @if(isset($record))
                        {{$record['name']}} {{$record['surname']}}
                    @endif.</h1>
            </div>
            <form action="{{route('tables.author.update', ['id' => $record['id']])}}" method="POST">
                @csrf

                <x-input type="text"
                               id="name"
                               name="name"
                               label="Author Name"
                               help="if you change a name, the first name of author will be registered as a new one"
                               :value="isset($record) ? $record['name'] : null"/>

                <x-input type="text"
                               id="surname"
                               name="surname"
                               label="Author surname"
                               :value="isset($record) ? $record['surname'] : null"/>

                <div class="d-flex align-items-center justify-content-around" role="group"
                     aria-label="Basic example">
                    <button type="submit" class="btn btn-ocean" style="width: 15%">Send</button>
                    <a href="{{ route('tables.author.index') }}" class="btn btn-danger" style="width: 15%">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
