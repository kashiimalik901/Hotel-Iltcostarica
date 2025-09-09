<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- ===============================================-->
  <!--    Document Title-->
  <!-- ===============================================-->
  <title>{{ config('app.name', 'Hotel Costa Rica') }} - Admin Dashboard</title>

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
  
  <!-- ===============================================-->
  <!--    Stylesheets-->
  <!-- ===============================================-->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
  
  <!-- Vendor CSS -->
  <link href="{{ asset('falcon/vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
  <link href="{{ asset('falcon/assets/css/theme.css') }}" rel="stylesheet" id="style-default">
  <link href="{{ asset('falcon/assets/css/user.css') }}" rel="stylesheet" id="user-style-default">
  
  <!-- Config JS -->
  <script src="{{ asset('falcon/assets/js/config.js') }}"></script>
</head>

<body>
  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <main class="main" id="top">
    <div class="container-fluid" data-layout="container">
      <script>
        var isFluid = JSON.parse(localStorage.getItem('isFluid'));
        if (isFluid) {
          var container = document.querySelector('[data-layout]');
          container.classList.remove('container');
          container.classList.add('container-fluid');
        }
      </script>
      <nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
        <script>
          var navbarStyle = localStorage.getItem("navbarStyle");
          if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
          }
        </script>
        <div class="d-flex align-items-center">
          <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation">
              <span class="navbar-toggle-icon">
                <span class="toggle-line"></span>
              </span>
            </button>
          </div>
          <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <div class="d-flex align-items-center py-3">
              <img class="me-2" src="{{ asset('falcon/assets/img/icons/spot-illustrations/falcon.png') }}" alt="" width="40" />
              <span class="font-sans-serif text-primary">Hotel Costa Rica</span>
            </div>
          </a>
        </div>
        <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
          <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
              <li class="nav-item">
                <!-- parent pages-->
                <a class="nav-link active" href="{{ route('admin.dashboard') }}" role="button">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon">
                      <i class="fas fa-chart-pie"></i>
                    </span>
                    <span class="nav-link-text ps-1">Dashboard</span>
                  </div>
                </a>
              </li>
              <li class="nav-item">
                <!-- label-->
                <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                  <div class="col-auto navbar-vertical-label">Management</div>
                  <div class="col ps-0">
                    <hr class="mb-0 navbar-vertical-divider" />
                  </div>
                </div>
                <!-- parent pages-->
                <!-- <a class="nav-link" href="{{ route('admin.hotels.index') }}" role="button"> -->
                <a class="nav-link" href="{{ route('admin.dashboard') }}" role="button">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon">
                      <i class="fas fa-building"></i>
                    </span>
                    <span class="nav-link-text ps-1">Hotels</span>
                  </div>
                </a>
                <!-- parent pages-->
                <!-- <a class="nav-link" href="{{ route('admin.rooms.index') }}" role="button"> -->
                <a class="nav-link" href="{{ route('admin.dashboard') }}" role="button">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon">
                      <i class="fas fa-bed"></i>
                    </span>
                    <span class="nav-link-text ps-1">Rooms</span>
                  </div>
                </a>
                <!-- parent pages-->
                <!-- <a class="nav-link" href="{{ route('admin.bookings.index') }}" role="button"> -->
                <a class="nav-link" href="{{ route('admin.boodashboard') }}" role="button">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon">
                      <i class="fas fa-calendar-check"></i>
                    </span>
                    <span class="nav-link-text ps-1">Bookings</span>
                  </div>
                </a>
                <!-- parent pages-->
                <!-- <a class="nav-link" href="{{ route('admin.customers.index') }}" role="button"> -->
                <a class="nav-link" href="{{ route('admin.custdashboard') }}" role="button">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon">
                      <i class="fas fa-users"></i>
                    </span>
                    <span class="nav-link-text ps-1">Customers</span>
                  </div>
                </a>
              </li>
              <li class="nav-item">
                <!-- label-->
                <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                  <div class="col-auto navbar-vertical-label">Settings</div>
                  <div class="col ps-0">
                    <hr class="mb-0 navbar-vertical-divider" />
                  </div>
                </div>
                <!-- parent pages-->
                <a class="nav-link" href="#" role="button">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon">
                      <i class="fas fa-cog"></i>
                    </span>
                    <span class="nav-link-text ps-1">System Settings</span>
                  </div>
                </a>
              </li>
            </ul>
            <div class="settings px-3 px-xl-0">
              <div class="d-grid">
                <div class="upgrade-card bg-soft-warning">
                  <div class="card-body text-center px-2 py-3">
                    <div class="text-center"><img src="{{ asset('falcon/assets/img/icons/spot-illustrations/navbar-vertical.png') }}" alt="" width="80" />
                      <p class="fs-11 mt-2">Hotel Management System<br />Powered by Falcon</p>
                      <div class="d-grid">
                        <a class="btn btn-sm btn-primary" href="#" target="_blank">Learn More</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </nav>
      <div class="content">
        <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">
          <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggle-icon">
              <span class="toggle-line"></span>
            </span>
          </button>
          <a class="navbar-brand me-1 me-sm-3" href="{{ route('admin.dashboard') }}">
            <div class="d-flex align-items-center">
              <img class="me-2" src="{{ asset('falcon/assets/img/icons/spot-illustrations/falcon.png') }}" alt="" width="40" />
              <span class="font-sans-serif text-primary">Hotel Costa Rica</span>
            </div>
          </a>
          <ul class="navbar-nav align-items-center d-none d-lg-block">
            <li class="nav-item">
              <div class="search-box" data-list='{"valueNames":["title"]}'>
                <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
                  <input class="form-control search-input fuzzy-search" type="search" placeholder="Search..." aria-label="Search" />
                  <i class="fas fa-search search-box-icon"></i>
                </form>
                <div class="btn-close-falcon-container position-absolute end-0 top-50 translate-middle shadow-none" data-bs-dismiss="search">
                  <button class="btn btn-link btn-close-falcon p-0" aria-label="Close"></button>
                </div>
                <div class="dropdown-menu border font-base start-0 mt-2 py-0 overflow-hidden w-100">
                  <div class="scrollbar list py-3" style="max-height: 24rem;">
                    <h6 class="dropdown-header fw-medium text-uppercase px-x1 fs-11 pt-0 pb-2">Quick Actions</h6>
                    <a class="dropdown-item fs-10 px-x1 py-1 hover-primary" href="{{ route('admin.hotels.create') }}">
                      <div class="d-flex align-items-center">
                        <i class="fas fa-circle me-2 text-300 fs-11"></i>
                        <div class="fw-normal title">Add New Hotel</div>
                      </div>
                    </a>
                    <a class="dropdown-item fs-10 px-x1 py-1 hover-primary" href="{{ route('admin.rooms.create') }}">
                      <div class="d-flex align-items-center">
                        <i class="fas fa-circle me-2 text-300 fs-11"></i>
                        <div class="fw-normal title">Add New Room</div>
                      </div>
                    </a>
                    <a class="dropdown-item fs-10 px-x1 py-1 hover-primary" href="{{ route('admin.bookings.create') }}">
                      <div class="d-flex align-items-center">
                        <i class="fas fa-circle me-2 text-300 fs-11"></i>
                        <div class="fw-normal title">Create New Booking</div>
                      </div>
                    </a>
                  </div>
                  <div class="text-center mt-n3">
                    <p class="fallback fw-bold fs-8 d-none">No Result Found.</p>
                  </div>
                </div>
              </div>
            </li>
          </ul>
          <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
            <li class="nav-item ps-2 pe-0">
              <div class="dropdown theme-control-dropdown">
                <a class="nav-link d-flex align-items-center dropdown-toggle fa-icon-wait fs-9 pe-1 py-0" href="#" role="button" id="themeSwitchDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-sun fs-7" data-fa-transform="shrink-2" data-theme-dropdown-toggle-icon="light"></i>
                  <i class="fas fa-moon fs-7" data-fa-transform="shrink-3" data-theme-dropdown-toggle-icon="dark"></i>
                  <i class="fas fa-adjust fs-7" data-fa-transform="shrink-2" data-theme-dropdown-toggle-icon="auto"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-caret border py-0 mt-3" aria-labelledby="themeSwitchDropdown">
                  <div class="bg-white dark__bg-1000 rounded-2 py-2">
                    <button class="dropdown-item d-flex align-items-center gap-2" type="button" value="light" data-theme-control="theme">
                      <i class="fas fa-sun"></i>Light
                      <i class="fas fa-check dropdown-check-icon ms-auto text-600"></i>
                    </button>
                    <button class="dropdown-item d-flex align-items-center gap-2" type="button" value="dark" data-theme-control="theme">
                      <i class="fas fa-moon" data-fa-transform=""></i>Dark
                      <i class="fas fa-check dropdown-check-icon ms-auto text-600"></i>
                    </button>
                    <button class="dropdown-item d-flex align-items-center gap-2" type="button" value="auto" data-theme-control="theme">
                      <i class="fas fa-adjust" data-fa-transform=""></i>Auto
                      <i class="fas fa-check dropdown-check-icon ms-auto text-600"></i>
                    </button>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link notification-indicator notification-indicator-primary px-0 fa-icon-wait" id="navbarDropdownNotification" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hide-on-body-scroll="data-hide-on-body-scroll">
                <i class="fas fa-bell" data-fa-transform="shrink-6" style="font-size: 33px;"></i>
              </a>
              <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end dropdown-menu-card dropdown-menu-notification dropdown-caret-bg" aria-labelledby="navbarDropdownNotification">
                <div class="card card-notification shadow-none">
                  <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                      <div class="col-auto">
                        <h6 class="card-header-title mb-0">Notifications</h6>
                      </div>
                      <div class="col-auto ps-0 ps-sm-3">
                        <a class="card-link fw-normal" href="#">Mark all as read</a>
                      </div>
                    </div>
                  </div>
                  <div class="scrollbar-overlay" style="max-height:19rem">
                    <div class="list-group list-group-flush fw-normal fs-10">
                      <div class="list-group-title border-bottom">NEW</div>
                      <div class="list-group-item">
                        <a class="notification notification-flush notification-unread" href="#!">
                          <div class="notification-avatar">
                            <div class="avatar avatar-2xl me-3">
                              <img class="rounded-circle" src="{{ asset('falcon/assets/img/team/1-thumb.png') }}" alt="" />
                            </div>
                          </div>
                          <div class="notification-body">
                            <p class="mb-1"><strong>Welcome!</strong> Your hotel management system is ready.</p>
                            <span class="notification-time">
                              <span class="me-2" role="img" aria-label="Emoji">🎉</span>Just now
                            </span>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-center border-top">
                    <a class="card-link d-block" href="#">View all</a>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-xl">
                  <img class="rounded-circle" src="{{ asset('falcon/assets/img/team/3-thumb.png') }}" alt="" />
                </div>
              </a>
              <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                <div class="bg-white dark__bg-1000 rounded-2 py-2">
                  <a class="dropdown-item" href="#!">Profile &amp; account</a>
                  <a class="dropdown-item" href="#!">Settings</a>
                  <div class="dropdown-divider"></div>
                  <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                  </form>
                </div>
              </div>
            </li>
          </ul>
        </nav>

        @yield('content')
      </div>
    </div>
  </main>

  <!-- ===============================================-->
  <!--    JavaScripts-->
  <!-- ===============================================-->
  <!-- Load Popper.js first (required for Bootstrap dropdowns) -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  
  <!-- Load jQuery -->
  <script src="{{ asset('falcon/vendors/jquery/jquery.min.js') }}"></script>
  
  <!-- Load Bootstrap (with Popper.js dependency satisfied) -->
  <script src="{{ asset('falcon/vendors/bootstrap/bootstrap.min.js') }}"></script>
  
  <!-- Load other vendor scripts -->
  <script src="{{ asset('falcon/vendors/simplebar/simplebar.min.js') }}"></script>
  <script src="{{ asset('falcon/vendors/choices/choices.min.js') }}"></script>
  <script src="{{ asset('falcon/vendors/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('falcon/vendors/lodash/lodash.min.js') }}"></script>
  <script src="{{ asset('falcon/vendors/list.js/list.min.js') }}"></script>
  <script src="{{ asset('falcon/vendors/anchorjs/anchor.min.js') }}"></script>
  <script src="{{ asset('falcon/vendors/is/is.min.js') }}"></script>
  <script src="{{ asset('falcon/vendors/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('falcon/vendors/fontawesome/all.min.js') }}"></script>
  <script src="{{ asset('falcon/assets/js/theme.js') }}"></script>

  @stack('scripts')

  <script>
    // Initialize theme switcher
    document.addEventListener('DOMContentLoaded', function() {
      // Wait for FontAwesome to load
      if (typeof FontAwesome !== 'undefined') {
        FontAwesome.dom.i2svg();
      }
      
      // Theme switcher functionality
      const themeButtons = document.querySelectorAll('[data-theme-control="theme"]');
      const themeToggleIcons = document.querySelectorAll('[data-theme-dropdown-toggle-icon]');
      
      // Get current theme from localStorage or default to 'light'
      const currentTheme = localStorage.getItem('theme') || 'light';
      
      // Apply current theme
      applyTheme(currentTheme);
      
      // Update theme switcher UI
      updateThemeSwitcherUI(currentTheme);
      
      themeButtons.forEach(button => {
        button.addEventListener('click', function() {
          const theme = this.value;
          localStorage.setItem('theme', theme);
          applyTheme(theme);
          updateThemeSwitcherUI(theme);
        });
      });

      // Initialize tooltips
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });

      // Initialize popovers
      var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
      var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
      });
      
      // Ensure Bootstrap dropdowns are properly initialized
      console.log('Bootstrap version:', bootstrap?.version);
      console.log('Popper version:', window.Popper?.version);
    });
    
    // Function to apply theme
    function applyTheme(theme) {
      const html = document.documentElement;
      const body = document.body;
      
      // Remove existing theme classes
      html.classList.remove('data-bs-theme-light', 'data-bs-theme-dark');
      body.classList.remove('light', 'dark');
      
      // Apply new theme
      if (theme === 'dark') {
        html.setAttribute('data-bs-theme', 'dark');
        body.classList.add('dark');
      } else if (theme === 'light') {
        html.setAttribute('data-bs-theme', 'light');
        body.classList.add('light');
      } else if (theme === 'auto') {
        // Auto theme - check system preference
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
          html.setAttribute('data-bs-theme', 'dark');
          body.classList.add('dark');
        } else {
          html.setAttribute('data-bs-theme', 'light');
          body.classList.add('light');
        }
      }
    }
    
    // Function to update theme switcher UI
    function updateThemeSwitcherUI(theme) {
      const themeButtons = document.querySelectorAll('[data-theme-control="theme"]');
      const themeToggleIcons = document.querySelectorAll('[data-theme-dropdown-toggle-icon]');
      
      // Remove all check marks
      themeButtons.forEach(btn => {
        const checkIcon = btn.querySelector('.dropdown-check-icon');
        if (checkIcon) {
          checkIcon.style.display = 'none';
        }
      });
      
      // Show check mark for current theme
      themeButtons.forEach(btn => {
        if (btn.value === theme) {
          const checkIcon = btn.querySelector('.dropdown-check-icon');
          if (checkIcon) {
            checkIcon.style.display = 'block';
          }
        }
      });
      
      // Update toggle icon
      themeToggleIcons.forEach(icon => {
        if (icon.getAttribute('data-theme-dropdown-toggle-icon') === theme) {
          icon.style.display = 'block';
        } else {
          icon.style.display = 'none';
        }
      });
    }
  </script>
</body>

</html>
