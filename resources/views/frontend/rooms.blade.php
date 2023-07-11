@extends('frontend.master')

@section('content')

<div class="container">

<h2>Rooms</h2>
<!-- form -->

                    <div class="row">
                          <div class="col-sm-6 wowload fadeInUp">
                            @foreach($rooms as $room)
                            <div class="rooms">
                              <img src="{{ asset('images/rooms/' . $room->picture->file_name) }}"  class="img-responsive">

                              <div class="info">
                                <h3>{{ $room->name }}</h3>
                                <p>$/h {{ $room->price }}</p>
                                <p>{{ $room->roomType->name }}</p>
                                <a href="{{ url('/details') }}" class="btn btn-default">Xem chi tiết</a>
                              </div>
                            </div>
                            @endforeach
                          </div>
                          
                    </div>
                     <div class="text-center">
                     <ul class="pagination">
                     <li class="disabled"><a href="#">«</a></li>
                     <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                     <li><a href="#">2</a></li>
                     <li><a href="#">3</a></li>
                     <li><a href="#">4</a></li>
                     <li><a href="#">5</a></li>
                     <li><a href="#">»</a></li>
                     </ul>
                     </div>


</div>
@stop