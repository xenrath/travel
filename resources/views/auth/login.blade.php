<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- ===============================================-->
  <!--    Document Title-->
  <!-- ===============================================-->
  <title>Login | Travel</title>
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
</head>
<body>
  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <main class="main" id="top">
    <div class="container-fluid">
      <div class="row min-vh-100 bg-100">
        <div class="col-6 d-none d-lg-block position-relative">
          <div class="bg-holder"
            style="background-image:url({{ asset('falcon/public/assets/img/generic/login-image.jpg') }});background-position: 50% 20%;">
          </div>
          <!--/.bg-holder-->
        </div>
        <div class="col-sm-10 col-md-6 px-sm-0 align-self-center mx-auto py-5">
          <div class="row justify-content-center g-0">
            <div class="col-lg-9 col-xl-8 col-xxl-6">
              <div class="card">
                <div class="card-header bg-circle-shape bg-shape text-center p-2"><a
                    class="font-sans-serif fw-bolder fs-4 z-index-1 position-relative link-light light"
                    href="">Travel</a></div>
                <div class="card-body p-4">
                  <div class="row flex-between-center mb-3">
                    <div class="col-auto">
                      <h3>Login</h3>
                    </div>
                  </div>
                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                      <label class="form-label" for="telp">Username</label>
                      <input class="form-control @error('telp') is-invalid @enderror" name="telp" id="telp" type="telp"
                        value="{{ old('telp') }}" />
                      @error('telp')
                      <span class="invalid-feedback" role="alert">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">Password</label>
                      </div>
                      <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password"
                        value="{{ old('password') }}" />
                      @error('password')
                      <span class="invalid-feedback" role="alert">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="mt-5">
                      <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Masuk</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
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
  <script src="{{ asset('falcon/public/vendors/fontawesome/all.min.js') }}"></script>
  <script src="{{ asset('falcon/public/vendors/lodash/lodash.min.js') }}"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
  <script src="{{ asset('falcon/public/vendors/list.js/list.min.js') }}"></script>
  <script src="{{ asset('falcon/public/assets/js/theme.js') }}"></script>

</body>

</html>