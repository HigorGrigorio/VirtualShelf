<div class="form-group mt-2">
    @if($label)
        <label for="{{$name}}">${{$label}}</label>
    @endif
    <input type="text" name="{{$name}}"
           class="form-control @if($errors->has($name)) is-invalid @else input-smoke @endif"
           id="{{$name}}"
           aria-describedby="{{$ariaDescribedby}}"
           placeholder="{{$placeholder}}"
           value="{{old($name)}}">
    @if($errors->has($name))
        @foreach($errors->get($name) as $message)
            <small class="form-text text-danger">
                {{$message}}
            </small>
        @endforeach
    @else
        @if($help)
            <small id="email-help" class="form-text text-muted">
                {{$help}}
            </small>
        @endif
    @endif
</div>
