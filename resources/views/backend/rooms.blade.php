@extends('backend.master')

@section('main')
          <div class="data-scrollbar" data-scroll="1">
              <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                      <li class="">
                          <a href="{{ url('admin-dashboard') }}" class="svg-icon">                        
                              <svg  class="svg-icon" id="p-dash1" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line>
                              </svg>
                              <span class="ml-4">Dashboards</span>
                          </a>
                      </li>
                      <li class=" ">
                          <a href="#people" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                              </svg>
                              <span class="ml-4">Users</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="people" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="">
                                          <a href="{{ url('admin-users') }}">
                                              <i class="las la-minus"></i><span>Users</span>
                                          </a>
                                  </li>
                                  <li class="">
                                          <a href="{{ url('admin-user-add') }}">
                                              <i class="las la-minus"></i><span>Add User</span>
                                          </a>
                                  </li> 
                          </ul>
                      </li>
                      <li class=" ">
                          <a href="#purchase" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <svg class="svg-icon" id="p-dash5" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                  <line x1="1" y1="10" x2="23" y2="10"></line>
                              </svg>
                              <span class="ml-4">Services</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="purchase" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                  <li class="">
                                          <a href="{{ url('admin-services') }}">
                                              <i class="las la-minus"></i><span>List Services</span>
                                          </a>
                                  </li>
                                  <li class="">
                                          <a href="{{ url('admin-service-add') }}">
                                              <i class="las la-minus"></i><span>Add Service</span>
                                          </a>
                                  </li>
                          </ul>
                      </li>
                      <li class=" ">
                          <a href="#sale" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <svg class="svg-icon" id="p-dash4" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                              </svg>
                              <span class="ml-4">Room Types</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="sale" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                  <li class="">
                                          <a href="{{ url('admin-room-types') }}">
                                              <i class="las la-minus"></i><span>List Room Types</span>
                                          </a>
                                  </li>
                                  <li class="">
                                          <a href="{{ url('admin-room-type-add') }}">
                                              <i class="las la-minus"></i><span>Add Room Type</span>
                                          </a>
                                  </li>
                          </ul>
                      </li>
                      <li class=" ">
                          <a href="#category" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <svg class="svg-icon" id="p-dash3" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                  <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                              </svg>
                              <span class="ml-4">Rooms</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="category" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                  <li class="active">
                                          <a href="{{ url('admin-rooms') }}">
                                              <i class="las la-minus"></i><span>List Rooms</span>
                                          </a>
                                  </li>
                                  <li class="">
                                          <a href="{{ url('admin-room-add') }}">
                                              <i class="las la-minus"></i><span>Add Room</span>
                                          </a>
                                  </li>
                          </ul>
                      </li>
                      <li class=" ">
                          <a href="#product" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <svg class="svg-icon" id="p-dash2" width="20" height="20"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle>
                                  <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                              </svg>
                              <span class="ml-4">Orders</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="product" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                              <li class="">
                                  <a href="{{ url('admin-orders') }}">
                                      <i class="las la-minus"></i><span>List Order</span>
                                  </a>
                              </li>
                              <li class="">
                                  <a href="{{ url('admin-order-add') }}">
                                      <i class="las la-minus"></i><span>Add Order</span>
                                  </a>
                              </li>
                          </ul>
                      </li>
                  </ul>
              </nav>
              
          </div>
      </div>  
<!-- main -->    
<div class="content-page">
     <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">List Rooms </h4>
                        <p class="mb-0">@include('errors.note')</p>
                    </div>
                    <a  href="{{ url('admin-room-add') }}"class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Add Room</a>
                </div>
            </div>
            <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
                <table class="data-table table mb-0 tbl-server-info">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">                      
                            <th>Name</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Room Type</th>
                            <th>Status</th>
                            <th>Images</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach($rooms as $room)
                        <tr>
                            <td>{{ $room->name }}</td>
                            <td>{{ $room->size }} m²</td>
                            <td> $/h {{ $room->price }}</td>
                            <td>{{ $room->roomType->name }}</td>
                            <!-- Maintenance(Đang bảo trì)
                            Vacancy(Phòng trống) 
                            Active(Đang hoạt động)-->
                            <td>
                                <div class="status-badge">
                                    @if ($room->status === 'active')
                                        <span class="badge bg-warning-light">Active</span>
                                    @elseif ($room->status === 'maintenance')
                                        <span class="badge bg-danger-light">Maintenance</span>
                                    @elseif ($room->status === 'vacancy')
                                        <span class="badge bg-info-light">Vacancy</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div id="carousel-{{ $room->id }}" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        @if ($room->image1) <li data-target="#carousel-{{ $room->id }}" data-slide-to="0" class="active"></li> @endif
                                        @if ($room->image2) <li data-target="#carousel-{{ $room->id }}" data-slide-to="1"></li> @endif
                                        @if ($room->image3) <li data-target="#carousel-{{ $room->id }}" data-slide-to="2"></li> @endif
                                        @if ($room->image4) <li data-target="#carousel-{{ $room->id }}" data-slide-to="3"></li> @endif
                                        @if ($room->image5) <li data-target="#carousel-{{ $room->id }}" data-slide-to="4"></li> @endif
                                    </ol>
                                    <div class="carousel-inner">                                                
                                        @if ($room->image1) <div class="carousel-item active"><img src="{{ asset('images/rooms/' . $room->image1) }}" class="img-fluid rounded avatar-50 mr-3" alt="image"></div> @endif
                                        @if ($room->image2) <div class="carousel-item"><img src="{{ asset('images/rooms/' . $room->image2) }}" class="img-fluid rounded avatar-50 mr-3" alt="image"></div> @endif
                                        @if ($room->image3) <div class="carousel-item"><img src="{{ asset('images/rooms/' . $room->image3) }}" class="img-fluid rounded avatar-50 mr-3" alt="image"></div> @endif
                                        @if ($room->image4) <div class="carousel-item"><img src="{{ asset('images/rooms/' . $room->image4) }}" class="img-fluid rounded avatar-50 mr-3" alt="image"></div> @endif
                                        @if ($room->image5) <div class="carousel-item"><img src="{{ asset('images/rooms/' . $room->image5) }}" class="img-fluid rounded avatar-50 mr-3" alt="image"></div> @endif
                                    </div>
                                    <a class="carousel-control-prev" href="#carousel-{{ $room->id }}" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel-{{ $room->id }}" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </td>                            
                            <td>{{ $room->description }}</td>
                            <td>
                                <div class="d-flex align-items-center list-action">
                                    @if ($room->status !== 'active')
                                        <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="Edit" href="{{ route('roomedit', ['id' => $room->id]) }}"><i class="ri-pencil-line mr-0"></i></a>
                                        <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="Delete"  href="{{ route('deleteroom', ['id' => $room->id]) }}"><i class="ri-delete-bin-line mr-0"></i></a>
                                    @else
                                        <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="Edit" onclick="confirmEdit('{{ $room->id }}')"><i class="ri-pencil-line mr-0"></i></a>
                                        <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="Delete" onclick="confirmDelete('{{ $room->id }}')"><i class="ri-delete-bin-line mr-0"></i></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>  
            </div>
        </div>
        </div>
    </div>
        <!-- Page end  -->
    </div>
    <!-- Wrapper End-->
    <script>
        function confirmEdit(roomId) {
            if (confirm("This room is 'active'. Are you sure you want to edit?")) {
                window.location.href = "{{ route('roomedit', ['id' => ':id']) }}".replace(':id', roomId);
            }
        }
    
        function confirmDelete(roomId) {
            if (confirm("This room is 'active'. Are you sure you want to delete?")) {
                window.location.href = "{{ route('deleteroom', ['id' => ':id']) }}".replace(':id', roomId);
            }
        }
    </script>
@stop