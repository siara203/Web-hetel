<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>SDN Hotel | Account</title>
      
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
        <div class="iq-top-navbar" style="width: calc(100% - -1px);">
            <div class="iq-navbar-custom">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                       
                        
                        <a href="{{ url('/') }}" class="header-logo">
                            <img src="adm/images/logo.png" class="img-fluid rounded-normal" alt="logo">
                            <h5 class="logo-title ml-3">SDN Hotel</h5>
                        </a>
                        
                    </div>
                    <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                     <a class="navbar-brand" href="{{ url('/') }}"><img  src="{{ asset('adm/images/favicon.ico') }}" alt="SDN Hotel"></a>
                  </div>
                    <div class="d-flex align-items-center">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-label="Toggle navigation">
                            <i class="ri-menu-3-line"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                           <ul class="navbar-nav ml-auto navbar-list align-items-center nav">        
                              <li class="d-flex align-items-center justify-content-center mt-3"><a href="{{ url('/') }}" >Home</a></li>
                              <li class="d-flex align-items-center justify-content-center mt-3"><a href="{{ url('/rooms') }}">Rooms</a></li>
                              <li class="d-flex align-items-center justify-content-center mt-3"><a href="{{ url('/introduction') }}">Introduction</a></li>
                              <li class="d-flex align-items-center justify-content-center mt-3"><a href="{{ url('/services') }}">Services</a></li>
                              <li class="d-flex align-items-center justify-content-center mt-3"><a href="{{ url('/contact') }}">Contact</a></li>
                           </ul>
                            <ul class="navbar-nav ml-auto navbar-list align-items-center">
                                <li class="nav-item nav-icon dropdown caption-content">
                                    <div class="p-3">
                                        <div class="d-flex align-items-center justify-content-center mt-3">
                                            <a  href="{{asset('logout')}}" class="btn border">Logout</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div> 
        <!-- Wrapper Start -->    
    <div class="content-page" style="margin-left: -25px;margin-top: 76px" >
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12">
               <div class="card car-transparent">
                  <div class="card-body p-0">

                  </div>
               </div>
            </div>
         </div>
         <div class="row m-sm-0 px-3">            
            <div class="col-lg-4 card-profile" style="    max-width: 23%;">
               <div class="card card-block card-stretch card-height">
                  <div class="card-body">
                     <div class="d-flex align-items-center mb-3">
                        <div class="profile-img position-relative">
                           <img src="adm/images/user/1.png" class="img-fluid rounded avatar-110" alt="profile-image">
                        </div>
                        <div class="ml-3">
                           <h4 class="mb-1"> {{ Auth::user()->full_name }}</h4>
                        </div>
                     </div>
                     <p>Welcome <b>{{ Auth::user()->full_name }}</b> to SDN Hotel account! Here you can edit your account information, view your Order history.
                         If you have any difficulty please contact us. We are always here to support you.                   
                     </p>
                     <ul class="list-inline p-0 m-0">
                        <li class="mb-2">
                           <div class="d-flex align-items-center">
                              <svg class="svg-icon mr-3" height="16" width="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                              </svg>
                              <p class="mb-0">Address: {{ Auth::user()->address }}</p>
                           </div>
                        </li>
                        <li class="mb-2">
                           <div class="d-flex align-items-center">
                              <svg class="svg-icon mr-3" height="16" width="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                              </svg>
                              <p class="mb-0">Phone: {{ Auth::user()->phone }}</p>
                           </div>
                        </li>
                        <li>
                           <div class="d-flex align-items-center">
                              <svg class="svg-icon mr-3" height="16" width="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                              </svg>
                              <p class="mb-0">Email: {{ Auth::user()->email }}</p>
                           </div>
                        </li>
                        <li>
                            <div class="d-flex align-items-center">
                               <i class="far fa-calendar-alt svg-icon mr-3"></i>
                               <p class="mb-0">Created: {{ Auth::user()->created_at->format('D, h:i:s A  d/m/Y') }}</p>
                            </div>
                         </li>
                         
                         
                        <li>
                            <div class="d-flex align-items-center">
                                <i class="far fa-clock svg-icon mr-3"></i>
                                <p id="current-time" class="mb-0">Current time: </p>
                              </div>
                              
                        </li>
                        
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-lg-8 card-profile" style="flex: 1 0 66.66667%;max-width: 78%">
               <div class="card card-block card-stretch card-height">
                  <div class="card-body">
                     <ul class="d-flex nav nav-pills mb-3 text-center profile-tab" id="profile-pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" data-toggle="pill" href="#profile1" role="tab" aria-selected="false">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#profile2" role="tab" aria-selected="false">Edit account information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#profile3" role="tab" aria-selected="false">History</a>
                        </li>
                        <li class="nav-item">
                            <a id="view-btn" class="nav-link" data-toggle="pill" href="#profile5" role="tab" aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                           <p class="mb-0">@include('errors.note')</p>
                        </li>
                    </ul>
                     <div class="profile-content tab-content">  

                        <div id="profile1" class="tab-pane fade active show">
                           <p></p>
                           <div class="table-responsive">
                              <table class="table table-striped">
                                 <thead>
                                    <tr>
                                       <th>Room</th>
                                       <th style="padding-right: 55px">Services (Quantity)</th>
                                       <th style="font-size: 14px;">Check in date</th>
                                       <th style="font-size: 14px;">Check out date</th>
                                       <th tyle="font-size: 14px;">Status</th>
                                       <th style="padding-right: 55px;">Total</th>
                                       <th style="padding-right: 50px;">Description</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                       @foreach($orders as $order)
                                    <tr>
                                        <td>
                                            @foreach($order->rooms as $room)
                                                {{ $room->name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @if(isset($order->services) && count($order->services) > 0)
                                                @foreach($order->services as $key => $service)
                                                    {{ $service->name }} ({{ $order->getServiceQuantity($service->id) }})
                                                    @if($key < count($order->services) - 1)
                                                        <br>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{ date('D, h:i A  d/m/Y', strtotime($order->check_in_date)) }}</td>
                                        <td>{{ date('D, h:i A  d/m/Y', strtotime($order->check_out_date)) }}</td>
                                        <td>
                                            @if($order->status == 'cancelled')
                                                <span class="badge bg-warning-light">Cancelled</span>
                                            @elseif($order->status == 'pending')
                                                <span class="badge bg-danger-light">Pending</span>
                                            @elseif($order->status == 'approved')
                                                <span class="badge bg-pink">Approved</span>
                                            @elseif($order->status == 'active')
                                                <span class="badge bg-info-light">Active</span>
                                            @elseif($order->status == 'finished')
                                                <span class="badge bg-success-light">Finished</span>
                                            @endif
                                        </td>
                                       
                                        <td>
                                            @php
                                                $room = $order->rooms->first();
                                                $roomRate = $room->price;
                                                $totalTime = $order->getTotalHours();
                                                $servicePrice = $order->getTotalServiceAmount();
                                                $totalAmount = ($roomRate * $totalTime) + $servicePrice;
                                                if ($totalTime < 1) {
                                                    $totalTime = 1;
                                                }
                                            @endphp
                                            Time: {{ $totalTime }} h, <br>Room: $ {{ $roomRate * $totalTime }}<br>
                                            Services: {{ $servicePrice }} $<br>
                                            <i style="color: red">Total Amount: $ {{ $totalAmount + ($roomRate * $totalTime) }}</i>
                                        </td>
                                        
                                        <td>{{ $order->description }}</td>
                                        <td>
                                          <div class="d-flex align-items-center list-action">
                                             @if($order->status == 'pending')
                                                 <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="Cancelled" href="{{ route('ordercancel', $order->id) }}"><i class="fas fa-times" style="color: rgb(255, 255, 255)"></i></a>
                                                 <a class="badge bg-info mr-2" data-toggle="modal" data-target="#editModal{{ $order->id }}" data-placement="top" title="Edit" href="#"><i class="ri-pencil-line mr-0"></i></a>                               
                                                 <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="Payment" href="{{ route('payment', ['id' => $order->id]) }}"><i class="fas fa-money-bill-alt text-white"></i></a>
                                             @else
                                                 <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="Payment" href="{{ route('payment', ['id' => $order->id]) }}"><i class="fas fa-money-bill-alt text-white"></i></a>
                                             @endif
                                         </div>                                         
                                        </td>
                                    </tr>   
                                   
                                    <div class="modal fade" id="editModal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="editModal{{ $order->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content" style="width: 1000px;margin-left: -240px;height:650px">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModal{{ $order->id }}Label">Edit Order Information</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('updateorder', ['id' => $order->id]) }}" method="POST">
                                                        @csrf
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="check_out_date">Room</label>
                                                                <input type="text" class="form-control" value="@foreach($order->rooms as $room){{ $room->name }}@endforeach" readonly>
                                                            </div>  
                                                        </div>                                                        
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Services</label>
                                                                <div class="service-checkboxes">
                                                                    @foreach($services as $service)
                                                                        <div class="custom-control custom-checkbox custom-checkbox-color-check custom-control-inline">
                                                                            <input class="custom-control-input bg-primary" type="checkbox" name="service_id[]" value="{{ $service->id }}" id="service{{ $service->id }}" {{ $order->services->contains('id', $service->id) ? 'checked' : '' }}>
                                                                            <label class="custom-control-label" for="service{{ $service->id }}">
                                                                                {{ $service->name }}
                                                                            </label>
                                                                            <input type="number" name="quantity[]" class="form-control quantity-input" value="{{ $order->services->contains('id', $service->id) ? $order->services->find($service->id)->pivot->quantity : 0 }}" min="0">
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>                                                
                                                        <div class="form-group">
                                                            <label for="check_in_date">Check in date *</label>
                                                            <input type="datetime-local" name="check_in_date" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($order->check_in_date)) }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="check_out_date">Check out date *</label>
                                                            <input type="datetime-local" name="check_out_date" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($order->check_out_date)) }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Description</label>
                                                            <input type="text" id="description" name="description" value="{{ $order->description }}" class="form-control">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                               @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        
                        <div id="profile2" class="tab-pane fade">
                           <p></p>
                           <h3>Edit Profile</h3>
                           <form action="{{ route('updateinfo') }}" method="POST">
                              @csrf
                              <div class="form-group">
                                 <label for="full_name">Full Name</label>
                                 <input type="text" id="full_name" name="full_name" value="{{ $user->full_name }}" class="form-control">
                              </div>
                              <div class="form-group">
                                 <label for="email">Email</label>
                                 <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control">
                              </div>

                              <div class="form-group">
                                 <label for="address">Address</label>
                                 <input type="text" id="address" name="address" value="{{ $user->address }}" class="form-control">
                              </div>
                              <div class="form-group">
                                 <label for="phone">Phone</label>
                                 <input type="text" id="phone" name="phone" value="{{ $user->phone }}" class="form-control">
                              </div>
                              <div class="form-group">
                                 <label for="password_verification">Password Verification</label>
                                 <input type="password" id="password_verification" name="password_verification" class="form-control">
                              </div>
                              <button type="submit" name="update_info" class="btn btn-primary">Update Information</button>
                           </form>
                           <hr>
                           <hr>
                           
                           <h4>Change Password</h4>
                           <form action="{{ route('updateinfo') }}" method="POST">
                              @csrf
                              <div class="form-group">
                                 <label for="current_password">Current Password</label>
                                 <input type="password" id="current_password" name="current_password" class="form-control">
                              </div>
                              <div class="form-group">
                                 <label for="password">New Password</label>
                                 <input type="password" id="password" name="password" class="form-control">
                              </div>
                              <div class="form-group">
                                 <label for="password_confirmation">Confirm New Password</label>
                                 <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                              </div>
                              <button type="submit" name="update_password" class="btn btn-primary">Change Password</button>
                           </form>
                           
                        </div>
                           
                        <div id="profile3" class="tab-pane fade">
                           <div class="profile-line m-0 d-flex align-items-center justify-content-between position-relative">
                              <ul class="list-inline p-0 m-0 w-100">
                                 <li>
                                    <div class="row align-items-top">
                                       <div class="col-md-3">
                                          <h6 class="mb-2">{{ Auth::user()->created_at->format('D, h:i:s A') }}</br>
                                             {{ Auth::user()->created_at->format('d/m/Y') }}
                                          </h6>
                                       </div>
                                       <div class="col-md-9">
                                          <div class="media profile-media align-items-top">
                                             <div class="profile-dots border-primary mt-1"></div>
                                             <div class="ml-4">
                                                <h6 class=" mb-1">First time</h6>
                                                <p class="mb-0 font-size-14">It's time to create an account</p>
                                             </div>
                                          </div>   
                                       </div>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="row align-items-top">
                                       <div class="col-md-3">
                                          <h6 class="mb-2">{{ Auth::user()->updated_at->format('D, h:i:s A') }}</br>
                                             {{ Auth::user()->updated_at->format('d/m/Y') }}
                                       </div>
                                       <div class="col-md-9">
                                          <div class="media profile-media align-items-top">
                                             <div class="profile-dots border-primary mt-1"></div>
                                             <div class="ml-4">
                                                <h6 class=" mb-1">Update account</h6>
                                                <p class="mb-0 font-size-14">Last time you edited your account</p>
                                             </div>
                                          </div>                                    
                                       </div>
                                    </div>
                                 </li>
                                 @if($orders->count() > 0)
                                 @foreach($orders as $order)
                                     <li>
                                         <div class="row align-items-top">
                                             <div class="col-md-3">
                                                 <h6 class="mb-2">{{ $order->created_at->format('D, h:i:s A') }}</br>
                                                     {{ $order->created_at->format('d/m/Y') }}
                                                 </h6>
                                             </div>
                                             <div class="col-md-9">
                                                 <div class="media profile-media align-items-top">
                                                     <div class="profile-dots border-primary mt-1"></div>
                                                     <div class="ml-4">
                                                         <h6 class="mb-1">Order Information Room @foreach($order->rooms as $room){{ $room->name }}@endforeach</h6>
                                                         <p class="mb-0 font-size-14">Last time you placed an order</p>
                                                     </div>
                                                 </div>                                    
                                             </div>
                                         </div>
                                     </li>
                                 @endforeach
                             @else
                             <li>
                              <div class="row align-items-top">
                                  <div class="col-md-3">
                                      <h6 class="mb-2">-</br>
                                         -
                                      </h6>
                                  </div>
                                  <div class="col-md-9">
                                      <div class="media profile-media align-items-top">
                                          <div class="profile-dots border-primary mt-1"></div>
                                          <div class="ml-4">
                                              <h6 class="mb-1">No orders found</h6>
                                              <p class="mb-0 font-size-14"></p>
                                          </div>
                                      </div>                                    
                                  </div>
                              </div>
                          </li>
                             @endif                             
                              </ul>
                           </div>
                        </div>
                        
                        <div id="profile5" class="tab-pane fade">
                           <p style="text-align: center">Thank you for trusting and using our hotel. Wish you always healthy.</p>
                             <p style="text-align: center">------------------- Love you ! -------------------<p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
    </div>
    <!-- Wrapper End-->
    <footer class="iq-footer" style="width: calc(112vw - 222px);margin-left: 4px;">
            <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                           <ul class="list-inline mb-0">
                              
                          </ul>
                      </div>
                      <div class="col-lg-6 text-right">
                          <span class="mr-1">©<b><script>document.write(new Date().getFullYear())</script></span></b> <a href="#" class="">SDN Hotel</a>.
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

<script>
    function updateCurrentTime() {
       var currentTimeElement = document.getElementById('current-time');
       var currentTime = new Date();
 
       var daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
       var dayOfWeek = daysOfWeek[currentTime.getDay()];
 
       var hours = currentTime.getHours();
       var minutes = currentTime.getMinutes();
       var seconds = currentTime.getSeconds();
       var ampm = hours >= 12 ? 'PM' : 'AM';
       hours = hours % 12;
       hours = hours ? hours : 12;
       minutes = minutes < 10 ? '0' + minutes : minutes;
       seconds = seconds < 10 ? '0' + seconds : seconds;
 
       var date = currentTime.getDate();
       var month = currentTime.getMonth() + 1;
       var year = currentTime.getFullYear();
 
       var formattedTime = dayOfWeek + ', ' + hours + ':' + minutes + ':' + seconds + ' ' + ampm + '  ' + date + '/' + month + '/' + year;
 
       currentTimeElement.textContent = 'Current time: ' + formattedTime;
    }
    updateCurrentTime();
    setInterval(updateCurrentTime, 1000);
 </script>

  </body>
</html>