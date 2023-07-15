<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>SDN Hotel | Bill</title>
      
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
        <div class="content-page" style="margin-left: 7px;padding: 22px 15px 0px;">
            <div class="container-fluid">
               <div class="row">                  
                  <div class="col-lg-12">
                     <div class="card card-block card-stretch card-height print rounded">
                        <div class="card-header d-flex justify-content-between bg-primary header-invoice">
                              <div class="iq-header-title">
                                
                                 <h4 class="card-title mb-0">Invoice#{{ $order->id }}</h4>
                              </div>
                              <div class="invoice-btn">
                                 <button type="button" class="btn btn-primary-dark mr-2" onclick="window.print()"><i class="las la-print"></i> Print</button>
                             </div>
                        </div>
                        <div class="card-body">
                              <div class="row">
                                 <div class="col-sm-12">                                  
                                    <img src="adm/images/logo.png" class="logo-invoice img-fluid mb-3">
                                    <h5 class="mb-0">Hello,  {{ Auth::user()->full_name }}</h5>
                                    <h2 style="text-align: center"><b style="color: #32bdea">SDN</b> <b style="color: coral">Hotel</b></h2>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-12">
                                    <div class="table-responsive-sm">
                                          <table class="table">
                                             <thead>
                                                <tr>
                                                      <th scope="col">Order Check in date</th>
                                                      <th scope="col">Order Check out date</th>
                                                      <th scope="col">Order ID</th>
                                                      <th scope="col">Room</th>
                                                      <th scope="col">Services</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <tr>
                                                      <td>{{ date('D, h:i A', strtotime($order->check_in_date)) }}</br>
                                                         {{ date('d/m/Y', strtotime($order->check_in_date)) }}
                                                      </td>
                                                      <td>{{ date('D, h:i A', strtotime($order->check_out_date)) }}</br>
                                                         {{ date('d/m/Y', strtotime($order->check_out_date)) }}
                                                      </td>
                                                      <td>{{ $order->id }}</td>
                                                      <td>
                                                         @foreach($order->rooms as $room){{ $room->name }}@endforeach
                                                      </td>
                                                      <td>
                                                         @if(isset($order->services) && count($order->services) > 0)
                                                         @foreach($order->services as $key => $service)
                                                         {{ $service->name }}
                                                         @if($key < count($order->services) - 1)
                                                               , <br>
                                                         @endif
                                                         @endforeach
                                                         @endif
                                                      </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                    </div>
                                 </div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-sm-12">
                                    <h5 class="mb-3">Order Summary</h5>
                                    <div class="table-responsive-sm">
                                       <table class="table">
                                           <thead>
                                               <tr>
                                                   <th class="text-center" scope="col">#</th>
                                                   <th scope="col">Item</th>
                                                   <th class="text-center" scope="col">Quantity</th>
                                                   <th class="text-center" scope="col">Price</th>
                                                   <th class="text-center" scope="col">Totals</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                               @php
                                                   $totalAmount = 0;
                                               @endphp
                                               @foreach($order->services as $key => $service)
                                                   <tr>
                                                       <th class="text-center" scope="row">{{ $key + 1 }}</th>
                                                       <td>
                                                           <h6 class="mb-0">Service: {{ $service->name }}</h6>
                                                       </td>
                                                       <td class="text-center">{{ $service->pivot->quantity }}</td>
                                                       <td class="text-center">$ {{ $service->price }}</td>
                                                       <td class="text-center"><b>$ {{ $service->price * $service->pivot->quantity }}</b></td>
                                                   </tr>
                                                   @php
                                                       $totalAmount += $service->price * $service->pivot->quantity;
                                                   @endphp
                                               @endforeach
                                               <tr>
                                                   <th class="text-center" scope="row">{{ count($order->services) + 1 }}</th>
                                                   <td>
                                                       <h6 class="mb-0">Room: {{ $room->name }}</h6>
                                                   </td>
                                                   <td class="text-center">{{ $totalTime }} hours</td>
                                                   <td class="text-center">$ {{ $roomRate }}</td>
                                                   <td class="text-center"><b>$ {{ $roomRate * $totalTime }}</b></td>
                                               </tr>
                                               
                                           </tbody>
                                       </table>
                                   </div>
                                   
                                 </div>                              
                              </div>
                              <div class="row">
                                 <div class="col-sm-12">
                                    <b class="text-danger">Terms & Conditions</b>
                                    <p class="mb-0">
                                       The above payment should be made via cash, check, or deposit</br>
                                       This invoice is valid for 1 week</p></br><hr>
                                 </div>
                              </div>
                              <div class="row justify-content-between">
                                 <div class="col-4">
                                    <div class="payment-methods">
                                       
                                      
                                   </div>
                                   
                                 </div>
                                 
                                 <div class="col-4">
                                    <div class="or-detail rounded">
                                          <div class="p-3">
                                             <h5 class="mb-3">Order Details</h5>
                                             <div class="mb-2">
                                                <h6 class="payment-option"><svg class="bk-icon -streamline-credit_card_back " height="20" width="20" viewBox="0 0 24 24" role="presentation" aria-hidden="true" focusable="false">
                                                       <path d="M22.5 12v6.75a.75.75 0 0 1-.75.75H2.25a.75.75 0 0 1-.75-.75V5.25a.75.75 0 0 1 .75-.75h19.5a.75.75 0 0 1 .75.75V12zm1.5 0V5.25A2.25 2.25 0 0 0 21.75 3H2.25A2.25 2.25 0 0 0 0 5.25v13.5A2.25 2.25 0 0 0 2.25 21h19.5A2.25 2.25 0 0 0 24 18.75V12zM.75 9h22.5a.75.75 0 0 0 0-1.5H.75a.75.75 0 0 0 0 1.5zm4.5 4.5h8.25a.75.75 0 0 0 0-1.5H5.25a.75.75 0 0 0 0 1.5zm0 3h5.25a.75.75 0 0 0 0-1.5H5.25a.75.75 0 0 0 0 1.5z"></path>
                                                   </svg> Payment methods</h6>
                                                <p >
                                                   
                                                   
                                                    <img src="{{ asset('adm/images/icon/21.png') }}" alt="Payment Method">
                                                  
                                                    <i class="fas fa-money-bill" style="color: green;"></i>
        
                                               </p>
                                             </div>
                                             <div class="mb-2">
                                                <h6>Acc. No</h6>
                                                <p>{{$user->id}}</p>
                                             </div>
                                             <div class="mb-2">
                                                <h6>Due Date</h6>
                                                <p>{{ date('D, h:i A d/m/Y', strtotime($order->check_in_date . '+7 days')) }}</p>
                                             </div>
                                             <div class="mb-2">
                                                <h6>Sub Total</h6>
                                                <p>${{ $totalAmount + ($roomRate * $totalTime) }}</p>
                                             </div>
                                             <div>
                                                <h6>Discount</h6>
                                                <p>0%</p>
                                             </div>
                                          </div>
                                          <div class="ttl-amt py-2 px-3 d-flex justify-content-between align-items-center">
                                             <h6>Total</h6>
                                             <h3 class="text-primary font-weight-700"><td class="text-center"><b>$ {{ $totalAmount + ($roomRate * $totalTime) }}</b></td></h3>
                                          </div>
                                    </div>
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