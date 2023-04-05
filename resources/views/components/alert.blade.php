<div data-alert-count="{{ $id }}" class="alert animated flipInX alert-{{ $type }} alert-dismissible">
    <strong>
        <i class="{{ $icon }} me-3"></i>
        {{ $title }}
    </strong>
    <p class="p-3">{{ $message }}</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@if($timeout)
    @push('scripts')
        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    let alert = $('[data-alert-count]');

                    if (alert) {
                        alert.remove();
                    }
                }, {{ $timeout }});
            });
        </script>
    @endpush
@endif
