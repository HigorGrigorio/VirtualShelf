<div class="form-outline mb-5">
    <input value="{{ $value ?? old($name) }}" type="{{$type}}" id="{{$id}}" name="{{$name}}"
           class="form-control @error($name) is-invalid @enderror"/>
    @if(isset($label))
        {{-- if label is set --}}
        <label class="form-label" for="{{$name}}">{{$label}}</label>
    @endif
    @if(!$errors->has($name))
        @if(isset($help))
            <span class="form-helper">
                {{$help}}
            </span>
        @endif
    @endif

    @if($errors->has($name))
        @foreach($errors->get($name) as $message)
            <span class="form-helper" style="color: var(--mdb-danger)">
            {{$message}}
        </span>
        @endforeach
    @endif
</div>

