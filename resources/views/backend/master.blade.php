<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>SDN | Admin</title>

      <!-- Favicon -->
      <link rel="shortcut icon" href="{{ asset('adm/images/favicon.ico') }}" type="image/x-icon">
      <link rel="stylesheet" href="{{ asset('adm/css/backend-plugin.min.css') }}">
      <link rel="stylesheet" href="{{ asset('adm/css/backend.css?v=1.0.0') }}">
      <link rel="stylesheet" href="{{ asset('adm/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
      <link rel="stylesheet" href="{{ asset('adm/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
      <link rel="stylesheet" href="{{ asset('adm/vendor/remixicon/fonts/remixicon.css') }}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </head>
  <body class="  ">
    <!-- loader Start -->
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
      
      <div class="iq-sidebar  sidebar-default ">
          <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
              <a  href="{{ url('admin-dashboard') }}" class="header-logo">
                  <img  src="adm/images/logo.png"  alt="Favicon"  class="img-fluid rounded-normal light-logo" alt="logo"><h5 class="logo-title light-logo ml-3">SDN Hotel</h5>
              </a>
              <div class="iq-menu-bt-sidebar ml-0">
                  <i class="las la-bars wrapper-menu"></i>
              </div>
          </div>
          <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                        <i class="ri-menu-line wrapper-menu"></i>
                        <a href="{{ url('admin-dashboard') }}" class="header-logo">
                            <img src="adm/images/logo.png" class="img-fluid rounded-normal" alt="logo">
                            <h5 class="logo-title ml-3">SDN Hotel</h5>
                        </a>
                    </div>
                    <div class="iq-search-bar device-search">
                        <form action="#" class="searchbox">
                            <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                            <input type="text" class="text search-input" placeholder="Search here...">
                        </form>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-label="Toggle navigation">
                            <i class="ri-menu-3-line"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto navbar-list align-items-center">
                                <li class="nav-item nav-icon dropdown">
                                    <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-bell">
                                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                        </svg>
                                        <span class="bg-primary "></span>
                                    </a>
                                    <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <div class="card shadow-none m-0">
                                            <div class="card-body p-0">
                                                <div class="cust-title p-3">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <h5 class="mb-0">Notifications</h5>
                                                    </div>
                                                </div>
                                                <div class="px-3 pt-0 pb-0 sub-card">
                                                    <h6 style="color: rgb(58, 122, 232)" class="mb-0">New customers</h6>
                                                    @foreach(App\Models\User::latest()->take(2)->get() as $user)
                                                        <a href="#" class="iq-sub-card">
                                                            <div class="media align-items-center cust-card py-3 border-bottom">
                                                                <div class="media-body ml-3">
                                                                    <div class="d-flex align-items-center justify-content-between">
                                                                        <h6 class="mb-0">Full Name: {{ $user->full_name }}</h6>
                                                                        <small class="text-dark">
                                                                            <b>{{ $user->created_at->format('D, h:i A') }}</b></br>
                                                                            <b>{{ $user->created_at->format('d/m/Y') }}</b>
                                                                        </small>
                                                                    </div>
                                                                    <small class="mb-0">Email: {{ $user->email }}</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    @endforeach
                                                    <h6 style="color: rgb(58, 122, 232)" class="mb-0">New Orders</h6>
                                                    @foreach($orders->sortByDesc('created_at')->take(2) as $order)
                                                    
                                                        <a href="#" class="iq-sub-card">
                                                            <div class="media align-items-center cust-card py-3 border-bottom">
                                                                <div class="media-body ml-3">
                                                                    <div class="d-flex align-items-center justify-content-between">
                                                                        <h6 class="mb-0">Customer: {{ $order->user->full_name }}</h6>
                                                                        <small class="text-dark">
                                                                            <b>{{ date('D, h:i A', strtotime($order->check_in_date)) }}</b></br>
                                                                            <b>{{ date('d/m/Y', strtotime($order->check_in_date)) }}</b>
                                                                        </small>
                                                                    </div>
                                                                    <small class="mb-0">@foreach($order->rooms as $room)
                                                                                Room: {{ $room->name }}
                                                                                @endforeach</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    @endforeach                                           
                                                </div>            
                                            </div>
                                        </div>
                                    </div>
                                    
                                </li>
                                <li class="nav-item nav-icon dropdown caption-content">
                                    <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton4"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img  src="adm/images/user/1.png"  class="img-fluid rounded" alt="user">
                                    </a>
                                    <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <div class="card shadow-none m-0">
                                            <div class="card-body p-0 text-center">
                                                <div class="media-body profile-detail text-center">
                                                    <img src="adm/images/page-img/profile-bg.jpg" alt="profile-bg"
                                                        class="rounded-top img-fluid mb-4">
                                                    <img src="adm/images/user/1.png"   alt="profile-img"
                                                        class="rounded profile-img img-fluid avatar-70">
                                                </div>
                                                <div class="p-3">
                                                    <h5 class="mb-1"> {{ Auth::user()->full_name }}</h5>
                                                    <p class="mb-0"> {{ Auth::user()->email }}</p>
                                                    <div class="d-flex align-items-center justify-content-center mt-3">
                                                        <a href="" class="btn border mr-2">Profile</a>
                                                        <a  href="{{asset('logout')}}" class="btn border">Sign Out</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>  
      @yield('main')
      </div>
    </div>
    <!-- Wrapper End-->
    <footer class="iq-footer">
            <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item"><a href="{{ url('admin-privacy-policy') }}">Privacy Policy</a></li>
                                <li class="list-inline-item"><a href="{{ url('admin-terms-of-use') }}">Terms of Use</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 text-right">
                            <span class="mr-1"><script>document.write(new Date().getFullYear())</script>©</span> <a href="#" class="">SDN Hotel</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('adm/js/backend-bundle.min.js') }}"></script>

<!-- Table Treeview JavaScript -->
<script src="{{ asset('adm/js/table-treeview.js') }}"></script>

<!-- Chart Custom JavaScript -->
<script src="{{ asset('adm/js/customizer.js') }}"></script>

<!-- Chart Custom JavaScript -->
<script async src="{{ asset('adm/js/chart-custom.js') }}"></script>

<!-- app JavaScript -->
<script src="{{ asset('adm/js/app.js') }}"></script>

  </body>
</html>