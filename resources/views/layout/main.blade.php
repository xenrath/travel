<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- ===============================================-->
  <!--    Document Title-->
  <!-- ===============================================-->
  <title>@yield('title')</title>
  <!-- ===============================================-->
  <!--    Favicons-->
  <!-- ===============================================-->
  <link rel="apple-touch-icon" sizes="180x180"
    href="{{ asset('falcon/public/assets/img/favicons/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32"
    href="{{ asset('falcon/public/assets/img/favicons/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16"
    href="{{ asset('falcon/public/assets/img/favicons/favicon-16x16.png') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('falcon/public/assets/img/favicons/favicon.ico') }}">
  <link rel="manifest" href="{{ asset('falcon/public/assets/img/favicons/manifest.json') }}">
  <meta name="msapplication-TileImage" content="{{ asset('falcon/public/assets/img/favicons/mstile-150x150.png') }}">
  <meta name="theme-color" content="#ffffff">
  <script src="{{ asset('falcon/public/assets/js/config.js') }}"></script>
  <script src="{{ asset('falcon/public/vendors/overlayscrollbars/OverlayScrollbars.min.js') }}"></script>
  <!-- ===============================================-->
  <!--    Stylesheets-->
  <!-- ===============================================-->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
    rel="stylesheet">
  <link href="{{ asset('falcon/public/vendors/overlayscrollbars/OverlayScrollbars.min.css') }}" rel="stylesheet">
  <link href="{{ asset('falcon/public/assets/css/theme.min.css') }}" rel="stylesheet" id="style-default">
  <link href="{{ asset('falcon/public/assets/css/user.min.css') }}" rel="stylesheet" id="user-style-default">

  <link href="{{ asset('falcon/public/vendors/choices/choices.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('falcon/public/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('falcon/public/vendors/dropzone/dropzone.min.css') }}" rel="stylesheet">
  <link href="{{ asset('falcon/public/vendors/prism/prism-okaidia.css') }}" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <main class="main" id="top">
    <div class="container-fluid" data-layout="container">

      <!-- Start Main Sidebar -->

      @if (auth()->user()->isAdmin())
        @include('layout.menu.admin')
      @endif
      @if (auth()->user()->isOwner())
        @include('layout.menu.owner')
      @endif

      <!-- End Main Sidebar -->

      <div class="content">

        <!-- Start Main Navbar -->

        @include('layout.navbar')

        <!-- End Main Navbar -->

        <!-- Start Main Content -->

        @yield('content')

        <!-- End Main Content -->

        <!-- Start Main Footer -->

        @include('layout.footer')

        <!-- End Main Footer -->

      </div>

    </div>
  </main>
  <!-- ===============================================-->
  <!--    End of Main Content-->
  <!-- ===============================================-->

  <!-- ===============================================-->
  <!--    JavaScripts-->
  <!-- ===============================================-->
  <script src="{{ asset('falcon/public/vendors/popper/popper.min.js') }}"></script>
  <script src="{{ asset('falcon/public/vendors/bootstrap/bootstrap.min.js') }}"></script>
  <script src="{{ asset('falcon/public/vendors/anchorjs/anchor.min.js') }}"></script>
  <script src="{{ asset('falcon/public/vendors/is/is.min.js') }}"></script>
  <script src="{{ asset('falcon/public/vendors/dropzone/dropzone.min.js') }}"></script>
  <script src="{{ asset('falcon/public/vendors/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('falcon/public/vendors/fontawesome/all.min.js') }}"></script>
  <script src="{{ asset('falcon/public/vendors/lodash/lodash.min.js') }}"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
  <script src="{{ asset('falcon/public/vendors/list.js/list.min.js') }}"></script>
  <script src="{{ asset('falcon/public/assets/js/theme.js') }}"></script>
  <script src="{{ asset('falcon/public/vendors/countup/countUp.umd.js') }}"></script>
  <script src="{{ asset('falcon/public/vendors/typed.js/typed.js') }}"></script>

  <script src="{{ asset('falcon/public/vendors/choices/choices.min.js') }}"></script>
  <script src="{{ asset('falcon/public/assets/js/flatpickr.js') }}"></script>
  <script src="{{ asset('falcon/public/vendors/prism/prism.js') }}"></script>
</body>

</html>
