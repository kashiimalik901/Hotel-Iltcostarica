<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>{{ config('app.name', 'Hotel Costa Rica') }} | Welcome</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('falcon/assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('falcon/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('falcon/assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('falcon/assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('falcon/assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('falcon/assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('falcon/assets/js/config.js') }}"></script>
    <script src="{{ asset('falcon/vendors/simplebar/simplebar.min.js') }}"></script>

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('falcon/vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('falcon/assets/css/theme-rtl.css') }}" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('falcon/assets/css/theme.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('falcon/assets/css/user-rtl.css') }}" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('falcon/assets/css/user.css') }}" rel="stylesheet" id="user-style-default">
    <script>
        var isRTL = JSON.parse(localStorage.getItem('isRTL'));
        if (isRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>
</head>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container" data-layout="container">
            <script>
                var isFluid = JSON.parse(localStorage.getItem('isFluid'));
                if (isFluid) {
                    var container = document.querySelector('[data-layout]');
                    container.classList.remove('container');
                    container.classList.add('container-fluid');
                }
            </script>
            
            <!-- Header Navigation -->
            <header class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg">
                <nav class="navbar-nav navbar-nav-hover ms-auto">
                    <div class="nav-item dropdown">
                        @if (Route::has('login'))
                            @auth
                                <a class="btn btn-primary btn-sm" href="{{ url('/dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                                </a>
                            @else
                                <a class="btn btn-falcon-default btn-sm me-2" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-1"></i>Log in
                                </a>
                                @if (Route::has('register'))
                                    <a class="btn btn-primary btn-sm" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus me-1"></i>Register
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </nav>
            </header>

            <!-- Main Content -->
            <div class="row flex-center min-vh-100 py-6">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="text-center mb-4">
                        <img class="me-2" src="{{ asset('falcon/assets/img/icons/spot-illustrations/falcon.png') }}" alt="" width="80" />
                        <h1 class="font-sans-serif text-primary fw-bolder fs-1 d-inline-block">Hotel Costa Rica</h1>
                    </div>
                    
                    <div class="card">
                        <div class="card-body p-4 p-sm-5 text-center">
                            <div class="mb-4">
                                <i class="fas fa-hotel text-primary" style="font-size: 3rem;"></i>
                            </div>
                            
                            <h2 class="mb-3">Welcome to Hotel Costa Rica</h2>
                            <p class="text-muted mb-4">
                                Discover the perfect blend of luxury, comfort, and adventure in the heart of Costa Rica. 
                                Experience world-class hospitality with stunning views and exceptional service.
                            </p>
                            
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <div class="border rounded p-3">
                                        <i class="fas fa-mountain text-success mb-2" style="font-size: 1.5rem;"></i>
                                        <h6 class="mb-1">Mountain Views</h6>
                                        <small class="text-muted">Spectacular mountain landscapes</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border rounded p-3">
                                        <i class="fas fa-umbrella-beach text-info mb-2" style="font-size: 1.5rem;"></i>
                                        <h6 class="mb-1">Beach Access</h6>
                                        <small class="text-muted">Pristine beaches nearby</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                @if (Route::has('login'))
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg">
                                            <i class="fas fa-tachometer-alt me-2"></i>Go to Dashboard
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg mb-2">
                                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                                        </a>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                                                <i class="fas fa-user-plus me-2"></i>Create Account
                                            </a>
                                        @endif
                                    @endauth
                                @endif
                            </div>
                            
                            <div class="mt-4">
                                <small class="text-muted">
                                    Experience the magic of Costa Rica with us
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{ asset('falcon/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('falcon/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('falcon/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('falcon/assets/js/theme.js') }}"></script>
    
    <script>
        // Initialize FontAwesome
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof FontAwesome !== 'undefined') {
                FontAwesome.dom.i2svg();
            }
        });
    </script>
</body>

</html>
