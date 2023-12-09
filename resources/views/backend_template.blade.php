<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Breeze Admin</title>
    <link rel="stylesheet" href="{{ asset('backend/template/assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/template/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/template/assets/vendors/css/vendor.bundle.base.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/template/assets/vendors/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/template/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/template/assets/css/style.css') }}" />
    <link rel="shortcut icon" href="{{ asset('backend/template/assets/images/favicon.png') }}" />
    <!-- Datatable Css -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    <!-- End Datatable -->
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />

    <link rel="stylesheet" href="{{ asset('backend/template/assets/vendors/select2/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/template/assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}" />
  </head>
  <body>
    <div class="container-scroller" style="height: 100vh !important">
      @include('template.sidebar')
      <div class="container-fluid page-body-wrapper">
        @include('template.header')
        <div class="main-panel">
            <div class="content-wrapper pb-0" style="overflow-y: scroll;">
                @yield('content')
            </div>
          <!-- <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard template</a> from Bootstrapdash.com</span>
            </div>
          </footer> -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('backend/template/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('backend/template/assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('backend/template/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('backend/template/assets/vendors/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('backend/template/assets/vendors/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('backend/template/assets/vendors/flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('backend/template/assets/vendors/flot/jquery.flot.fillbetween.js') }}"></script>
    <script src="{{ asset('backend/template/assets/vendors/flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('backend/template/assets/vendors/flot/jquery.flot.pie.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('backend/template/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('backend/template/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('backend/template/assets/js/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('backend/template/assets/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->
    <!-- Datatable Js -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <!-- End Datatable -->
    <!-- Moment.js -->
    <script src="{{ asset('js/moment.js') }}"></script>
    <!-- common js for all page -->
    <script src="{{ asset('js/common.js') }}"></script>


    <script src="{{ asset('backend/template/assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('backend/template/assets/js/select2.js') }}"></script>

    @yield('scripts')
  </body>
</html>