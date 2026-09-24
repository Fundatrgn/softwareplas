<!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- loader-->
  <link href="{{asset('dashboard/assets/css/pace.min.css')}}" rel="stylesheet" />
  <script src="{{asset('dashboard/assets/js/pace.min.js')}}"></script>

  <!--plugins-->
  <link href="{{asset('dashboard/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />

  <!-- CSS Files -->
  <link href="{{asset('dashboard/assets/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('dashboard/assets/css/bootstrap-extended.css')}}" rel="stylesheet">
  <link href="{{asset('dashboard/assets/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('dashboard/assets/css/icons.css')}}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

  <title>Yönetim Paneli Girişi | {{ $settings->author ?? 'Yunuscan ZEYBEK' }}</title>
  <meta name="robots" content="noindex, nofollow">
</head>

<body class="bg-white">

  <!--start wrapper-->
  <div class="wrapper">
    <div class="">
      <div class="row g-0 m-0">
        <div class="col-xl-6 col-lg-12">
          <div class="login-cover-wrapper">
            <div class="card shadow-none">
              <div class="card-body">
                <div class="text-center">
                  <h4>{{ $settings->author ?? 'Yunuscan ZEYBEK' }}</h4>
                  <p>Yönetim Paneli Girişi</p>
                </div>
                @if ($errors->any())
                  <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif
                <form class="form-body row g-3" action="/login" method="POST">
                    @csrf
                  <div class="col-12">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required id="inputEmail" value="{{ old('email') }}" autocomplete="username">
                  </div>
                  <div class="col-12">
                    <label for="inputPassword" class="form-label">Şifre</label>
                    <input type="password" class="form-control" name="password" required id="inputPassword" autocomplete="current-password">
                  </div>
                  <div class="col-12 col-lg-6">
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" role="switch" name="remember" value="1" id="flexSwitchCheckRemember">
                      <label class="form-check-label" for="flexSwitchCheckRemember">Beni Hatırla</label>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 text-end">
                    {{-- <a href="authentication-reset-password-cover.html">Forgot Password?</a> --}}
                  </div>
                  <div class="col-12 col-lg-12">
                    <div class="d-grid">
                      <button type="submit" class="btn btn-primary">Giriş Yap</button>
                    </div>
                  </div>
                  {{-- <div class="col-12 col-lg-12">
                    <div class="position-relative border-bottom my-3">
                      <div class="position-absolute seperator translate-middle-y">or continue with</div>
                    </div>
                  </div> --}}
                  {{-- <div class="col-12 col-lg-12">
                    <div class="social-login d-flex flex-row align-items-center justify-content-center gap-2 my-2">
                      <a href="javascript:;" class=""><img src="assets/images/icons/facebook.png" alt=""></a>
                      <a href="javascript:;" class=""><img src="assets/images/icons/apple-black-logo.png" alt=""></a>
                      <a href="javascript:;" class=""><img src="assets/images/icons/google.png" alt=""></a>
                    </div>
                  </div> --}}
                  {{-- <div class="col-12 col-lg-12 text-center">
                    <p class="mb-0">Don't have an account? <a href="authentication-sign-up-cover.html">Sign up</a></p>
                  </div> --}}
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-lg-12">
          <div class="position-fixed top-0 h-100 d-xl-block d-none login-cover-img">
          </div>
        </div>
      </div>
      <!--end row-->
    </div>
  </div>
  <!--end wrapper-->


</body>

</html>