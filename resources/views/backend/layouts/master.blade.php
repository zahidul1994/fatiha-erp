<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('backend/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('backend/assets/img/agency.ico') }}">
    <title>@yield('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @laravelPWA
    <link href="{{ asset('backend/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="{{ asset('backend/assets/js/frontawesomekit.js') }}" crossorigin="anonymous"></script>
    <link href="{{ asset('backend/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('backend/assets/css/argon-dashboard.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('backend/assets/css/toastr.min.css') }}">
    <style>
        .ui-corner-all{
    font-size:20px;
    color: blue;
}
#preloader {
    position: fixed;
    top: 5%;
    left: 10%;
    width: 100%;
    height: 100%;
    z-index: 1000;
}

#preloader #preloader-inner {
    display: block;
    position: relative;
    left: 50%;
    top: 50%;
    width: 150px;
    height: 150px;
    margin: -75px 0 0 -75px;
    border-radius: 50%;
    border: 3px solid transparent;
    border-top-color: #3498db;
    animation: spin 2s linear infinite
}

#preloader #preloader-inner:before {
    content: "";
    position: absolute;
    top: 5px;
    left: 5px;
    right: 5px;
    bottom: 5px;
    border-radius: 50%;
    border: 3px solid transparent;
    border-top-color: #e74c3c;
    animation: spin 3s linear infinite
}

#preloader #preloader-inner:after {
    content: "";
    position: absolute;
    top: 15px;
    left: 15px;
    right: 15px;
    bottom: 15px;
    border-radius: 50%;
    border: 3px solid transparent;
    border-top-color: #f9c922;
    animation: spin 1.5s linear infinite
}

@keyframes spin {
    0% {
        transform: rotate(0deg)
    }
    to {
        transform: rotate(1turn)
    }
}
    </style>
    @stack('css')
    <style>
    .VIpgJd-ZVi9od-ORHb-OEVmcd{
        top: 93% !important;
        width: 48% !important;
        left: 30% !important;

    }
</style>
  <script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
    }
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>

<body class="g-sidenav-show bg-gray-100" style="font-family: 'Camber' !important">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>

    <!-- /sidebar menu  start-->
    @if(@Auth::user()->user_type=='Superadmin')
        @include('backend.includes.superadmin_sidebar')
        @elseif(@Auth::user()->user_type=='Admin')
        @if (Session::has('superAdminId'))
        <div class="container">
        <div class="alert alert-warning alert-dismissible text-white mx-auto" role="alert" style="width: 80%">
         &nbsp; Your Are login As guest Admin  &nbsp;<a href="{{url('admin/login-superadmin',Session::get('superAdminId'))}}" class="alert-link text-white"> &nbsp; &nbsp; Back To Super Admin</a> Only Back offfice User can see This Allert
        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
        </button>
        </div>
       </div>
        @endif
        @include('backend.includes.admin_sidebar')
       @else
        @include('backend.includes.employee_sidebar')
        @if (Session::has('adminId'))
        <div class="container">
         <div class="alert alert-warning alert-dismissible text-white mx-auto" role="alert" style="width: 80%">
        Your Are login As guest Admin  &nbsp;<a href="{{url('employee/login-superadmin',Session::get('adminId'))}}" class="alert-link text-white"> &nbsp; &nbsp; Back To Admin</a> Only Back offfice User can see This Allert
        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
        </button>
        </div>
       </div>
        @endif
        @endif

    <!-- /sidebar menu end -->

    <main class="main-content position-relative border-radius-lg ">
        <!-- header start -->
        @include('backend.includes.header')

        <!-- header end -->

        @yield('content')
            <!-- calculatore  -->
        @include('backend.includes.calculator')
        @include('backend.includes.footer')

    </main>
 <!--preloader-->
 <div id="preloader">
    <div id="preloader-inner"></div>
</div>
<!--preloader-->
    <!--   Core JS Files   -->

    <script src="{{ asset('backend/assets/js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <!-- calx -->
   @yield('calx')
    <script src="{{ asset('backend/assets/js/jquery.preloader.min.js') }}"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
       <script src="{{ asset('backend/assets/js/buttons.js') }}"></script>
    <script src="{{ asset('backend/assets/js/argon-dashboard.js') }}"></script>


    <script type="text/javascript">
        var url = "{{ URL::to('/') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
$(window).preloader({
    delay: 300
});

    </script>
    <script src="{{ asset('backend/assets/js/toastr.min.js') }}"></script>
    {!! @Toastr::message() !!}


    <script>
        //  document.addEventListener('contextmenu', event => event.preventDefault());
        function showTime(){
         var date = new Date();
         var h = date.getHours(); // 0 - 23
         var m = date.getMinutes(); // 0 - 59
         var s = date.getSeconds(); // 0 - 59
         var session = "AM";

         if(h == 0){
             h = 12;
         }

         if(h > 12){
             h = h - 12;
             session = "PM";
         }

         h = (h < 10) ? "0" + h : h;
         m = (m < 10) ? "0" + m : m;
         s = (s < 10) ? "0" + s : s;

         var time = h + ":" + m + ":" + s + " " + session;
         document.getElementById("MyClockDisplay").innerText = time;
         document.getElementById("MyClockDisplay").textContent = time;

         setTimeout(showTime, 1000);

     }

     showTime();
     $("#seennotify").hover(function(){
      '{{auth()->user()->unreadNotifications->markAsRead()}}'

        });
        </script>
@stack('js')
</body>

</html>
