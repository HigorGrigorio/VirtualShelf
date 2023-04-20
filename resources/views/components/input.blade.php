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
    @else
        <span class="form-helper" style="color: var(--mdb-danger);">
            {{ $errors->get($name)[0]}}
        </span>
    @endif
</div>

