<div class="form-outline mb-5">
    <textarea id="{{$id}}" name="{{$name}}"
              @if($max>0)
                  data-mdb-showcounter="true"
                  maxlength="{{$max}}"
              @endif
              class="form-control @error($name) is-invalid @enderror"
              rows="{{$rows}}">{{ $value ?? old($name) }}</textarea>
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

