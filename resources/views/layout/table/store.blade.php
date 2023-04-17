<x-app :tables="$tables" :table="$singular">
    <div class="pt-lg-5 d-flex align-items-center">
        <div class="container-sm d-flex flex-column w-75">
            <div>
                <h1 class="text-smoke">Editing {{$singular}}</h1>
            </div>
            <form action="{{ route('tables.' . $singular . '.store') }}" method="POST">
                @csrf

                @foreach($fillables as $field)
                    @component('components.input', [
                        'type' => 'text',
                        'id' => $field,
                        'name' => $field,
                        'label' => ucfirst($field),
                        'help' => $helps[$field] ?? null,
                        'value' => isset($model) ? $model[$field] : null
                    ]) @endcomponent
                @endforeach

                <div class="d-flex align-items-center justify-content-around" role="group"
                     aria-label="Basic example">
                    <button type="submit" class="btn btn-dark" style="width: 15%">Send</button>
                    <a href="{{ route($index) }}" class="btn btn-danger" style="width: 15%">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app>
