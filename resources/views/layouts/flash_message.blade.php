{{-- @if (Session::has('success'))
<div style="position: absolute;" class="bs-toast toast fade show bg-light" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <i class="ti ti-bell ti-xs me-2 text-secondary"></i>
      <div class="me-auto fw-semibold">RBA Notify</div>
      <small class="text-muted">momment ago</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body text-warning">
        {{ Session::get('success') }}
    </div>
  </div>
@endif --}}
@if (session()->has('message'))
    <script>
        $(document).ready(function() {
            $.toast({
                heading: 'Success',
                text: '{{ session()->get('message') }}',
                showHideTransition: 'fade',
                icon: 'success',
                position: 'top-right'
            });
        });
    </script>
@endif
@if (session()->has('status'))
    <script>
        $(document).ready(function() {
            $.toast({
                heading: 'Success',
                text: '{{ session()->get('status') }}',
                showHideTransition: 'fade',
                icon: 'success',
                position: 'top-right'
            });
        });
    </script>
@endif
@if (session()->has('success'))
    <script>
        $(document).ready(function() {
            $.toast({
                heading: 'Success',
                text: '{{ session()->get('success') }}',
                showHideTransition: 'fade',
                icon: 'success',
                position: 'top-right'
            });
        });
    </script>
@endif
@if (session()->has('warning'))
    <script>
        $(document).ready(function() {
            $.toast({
                heading: 'Message',
                text: '{{ session()->get('warning') }}',
                showHideTransition: 'fade',
                icon: 'warning',
                position: 'top-right'
            });
        });
    </script>
@endif
@if (session()->has('error'))
    <script>
        $(document).ready(function() {
            $.toast({
                heading: 'Error',
                text: '{{ session()->get('error') }}',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right'
            });
        });
    </script>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
    @endforeach
    @php
        $data = 'Error Accurs';
    @endphp
    <script>
        $(document).ready(function() {
            $.toast({
                heading: 'Error',
                text: '{{ $error }}',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right',
                hideAfter: 5000,
            });
        });
    </script>
@endif
