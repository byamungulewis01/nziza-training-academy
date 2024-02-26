@props(['status'])

@if ($status)
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <span class="alert-icon text-success me-2">
          <i class="ti ti-ban ti-xs"></i>
        </span>
        {{ $status }}
      </div>
@endif
