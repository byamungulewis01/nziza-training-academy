<!DOCTYPE html>
<!-- beautify ignore:start -->

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed " dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets') }}/" data-template="vertical-menu-template">


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title') - Nziza Training Academy</title>


    <meta name="description" content="Nziza Training Academy" />
    <meta name="keywords" content="Nziza Training Academy, Nziza">


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo/nziza-logo.png') }}" />
    <!-- Fonts -->

    <!-- Fonts -->
    <link rel="preconnect" href="{{ asset('assets/fonts/googleapis.com/index.html') }}">
    <link rel="preconnect" href="{{ asset('assets/fonts/gstatic.com/index.html') }}" crossorigin>
    <link href="{{ asset('assets/fonts/googleapis.com/css28ebe.css?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap') }}" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tablericons.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/toast/css/jquery.toast.css') }}">

    @yield('css')

    <!-- Form Validation -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>

  <!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar  ">
  <div class="layout-container">
    <x-sidebar/>


    <!-- Layout container -->
    <div class="layout-page">

    <x-navbar/>
      <!-- Content wrapper -->
      <div class="content-wrapper">

        {{ $slot }}

        <!-- Footer -->
        <x-footer/>
        <!-- / Footer -->
          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>



    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

  </div>
  <!-- / Layout wrapper -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>

  <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

  <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
  <!-- endbuild -->

  <!-- Main JS -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/toast/js/jquery.toast.js') }}"></script>

  @include('layouts.flash_message')
  <script>
      $(document).ready(function() {
          $("form").submit(function(event) {
              $(this).find("button[type=submit]").prop("disabled", true);
          });
      });
  </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @php
            $currentDate = now();
            $lastDayOfMonth = now()->endOfMonth();
            $remainingDays = $currentDate->diffInDays($lastDayOfMonth);
            $nextMonth = now()->addMonth()->firstOfMonth()->format('Y-m-d');
            $reported = App\Models\MonthlyGoal::where('month',$nextMonth)->where('user_id' ,auth()->user()->id)->first();
        @endphp
         @if ($remainingDays <= 4 && !$reported)
            @unless (Request::routeIs(['monthly_goals.index', 'monthly_goals.create', 'monthly_goals.edit', 'monthly_goals.show']))
                <script>
                    Swal.fire({
                        title: "<strong>Monthly Report</strong>",
                        icon: "info",
                        html: `You have to submit your monthly Goals before ending of this Month ,
                                    <a href="{{ route('monthly_goals.create') }}"> Click here to submit</a>`,
                        showCloseButton: true,
                        focusConfirm: false,
                        confirmButtonText: `<i class="fa fa-thumbs-up"></i> Great!`,
                        confirmButtonAriaLabel: "Thumbs up, great!",
                    });
                </script>
            @endunless
        @endif

  @yield('js')

  <!-- Vendors JS -->
  <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>


</body>


</html>
