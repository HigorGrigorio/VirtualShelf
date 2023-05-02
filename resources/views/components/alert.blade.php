<div id="alert-container">
    @if(isset($success))
        <div data-alert-count="1" class="alert animated flipInX alert-success alert-dismissible">
            <strong>
                <i class="fa fa-check me-3"></i>
                Success
            </strong>
            <p class="p-3">{{ $success }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(isset($danger))
        <div data-alert-count="2" class="alert animated flipInX alert-danger alert-dismissible">
            <strong>
                <i class="fa fa-times me-3"></i>
                Error
            </strong>
            <p class="p-3">{{ $danger }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(isset($warning))
        <div data-alert-count="3" class="alert animated flipInX alert-warning alert-dismissible">
            <strong>
                <i class="fa fa-exclamation-triangle me-3"></i>
                Warning
            </strong>
            <p class="p-3">{{ $warning }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(isset($info))
        <div data-alert-count="3" class="alert animated flipInX alert-info alert-dismissible">
            <strong>
                <i class="fa fa-exclamation-circle me-3"></i>
                Information
            </strong>
            <p class="p-3">{{ $info }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

