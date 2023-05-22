@extends('layouts.app', ['title' => 'Editing a publisher language'])

@section('content')
    <div class="pt-lg-5 d-flex align-items-center">
        <div class="container-sm d-flex flex-column w-75">
            <div>
                <h1 class="text-smoke">Editing an publishing language</h1>
            </div>
            <form action="{{ route('tables.'.$singular.'.update', ['id' => $record['id']]) }}" method="POST">
                @csrf

                <label class="form-label">Select a State</label>
                <!--State select-->
                <select name="publisher_id" class="form-select  @error('publisher_id') is-invalid @enderror"
                        aria-label="Publisher">
                    @foreach($publishers as $publisher)
                        <option
                            value="{{$publisher['id']}}" {{$publisher['id'] === $record['publisher_id'] ? 'selected' : ''}}>{{ $publisher['name'] }}</option>
                    @endforeach
                </select>

                @error('publisher_id')
                <span class="form-text text-danger">
                        {{$message}}
                    </span>
                @enderror

                <label class="form-label">Select a State</label>
                <!--State select-->
                <select name="language_id" class="form-select  @error('language_id') is-invalid @enderror"
                        aria-label="Language">
                    @foreach($languages as $language)
                        <option
                            value="{{$language['id']}}" {{$language['id'] === $record['language_id'] ? 'selected' : ''}}>{{ $language['name'] }}</option>
                    @endforeach
                </select>

                @error('language_id')
                <span class="form-text text-danger">
                        {{$message}}
                    </span>
                @enderror

                <div class="d-flex align-items-center justify-content-around mt-4" role="group"
                     aria-label="Basic example">
                    <button type="submit" class="btn btn-ocean" style="width: 15%">Send</button>
                    <a href="{{ route('tables.'.$singular.'.index') }}" class="btn btn-danger"
                       style="width: 15%">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
