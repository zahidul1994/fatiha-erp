
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('backend/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{ asset('backend/assets/img/agency.ico')}}">
  <meta property="og:site_name" content="Shop Management">
  <meta property="fb:app_id" content="209201484717774" />
  <link rel="canonical" href="{{ url()->current() }}">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!--============================= Author:Zahidul & Tanzir Nur =============================-->
  <!--============================= Developer: zahidul1994@github.com =============================-->
  <!--============================= Email: mjahid1990@gmail.com =============================-->
  {!! SEO::generate() !!}
  @laravelPWA
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('backend/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('backend/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('backend/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('backend/assets/css/argon-dashboard.css?v=2.0.5') }}" rel="stylesheet" />
</head>

<body class="">
  <main class="main-content main-content-bg mt-0">
    <div class="page-header min-vh-100" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-basic.jpg');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-7">
            <div class="card border-0 mb-0">
              <div class="card-header bg-transparent">
                <h5 class="text-dark text-center mt-2 mb-3">Register  Now</h5>

              </div>
              <div class="card-body px-lg-5 pt-0">
              @include('partial.formerror')
                <form role="form" class="text-start" method="post" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control  @error('name') is-invalid @enderror" value="{{ old('name') }}" required  name="name" placeholder="Name" aria-label="Name" autocomplete="name" autofocus>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control  @error('email') is-invalid @enderror" value="{{ old('email') }}" required  name="email" placeholder="Email" aria-label="Email" autocomplete="email" autofocus>
                    </div>
                    <div class="mb-3">
                        <input type="tel" class="form-control  @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required  name="phone" placeholder="Whatsapp Number" aria-label="Phone">
                      </div>
                    <div class="mb-3">
                        @auth
                        
                        <input type="text" class="form-control  @error('refer_code') is-invalid @enderror"    name="refer_code" value="{{Auth::user()->refer_id}}" readonly>  
                        @endauth
                        @guest
                        <input type="text" class="form-control  @error('refer_code') is-invalid @enderror" value="{{ old('zipcode') }}"   name="refer_code" placeholder="Refer Code" aria-label="refer_code">
                        
                        @endguest
                       
                        
                      </div>
                    <div class="mb-3">
                        <input type="text" class="form-control  @error('refer_code') is-invalid @enderror" value="{{ old('address') }}"   name="address" placeholder="City" aria-label="address">
                      </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-100 my-4 mb-2">Register</button>
                      </div>
                   </div>

                  <div class="card-footer text-center pt-0 px-sm-4 px-1">
                    <p class="mb-4 mx-auto">
                      Already have an account?
                      <a href="{{route('login')}}" class="text-primary font-weight-bold">Sign in</a>
                    </p>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->

  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="{{ asset('backend/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <!-- Kanban scripts -->
  <script src="{{ asset('backend/assets/js/plugins/dragula/dragula.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/plugins/jkanban/jkanban.js') }}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('backend/assets/js/argon-dashboard.min.js?v=2.0.5') }}"></script>
</body>

</html>

