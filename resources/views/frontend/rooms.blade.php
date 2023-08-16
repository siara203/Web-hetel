<link rel="stylesheet" href="{{ asset('backend/room.css') }}" />

@extends('frontend.master')

@section('content')

<div class="container">
<content>
<h2>TOYS</h2>
</content>

<!-- form -->

  <div class="rooms-group">
  <div class="row-index">
    @foreach($rooms as $room)
    <div class="col-xs-18 col-sm-6 col-md-4-index" >
      <div class="img_thumbnail productlist-index">
        <div id="carousel-{{ $room->id }}" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            @if ($room->picture) <li data-target="#carousel-{{ $room->id }}" data-slide-to="0" class="active"></li> @endif
            @if ($room->image2) <li data-target="#carousel-{{ $room->id }}" data-slide-to="1"></li> @endif
            @if ($room->image3) <li data-target="#carousel-{{ $room->id }}" data-slide-to="2"></li> @endif
            @if ($room->image4) <li data-target="#carousel-{{ $room->id }}" data-slide-to="3"></li> @endif
            @if ($room->image5) <li data-target="#carousel-{{ $room->id }}" data-slide-to="4"></li> @endif
          </ol>
          <div class="carousel-inner">
            @if ($room->picture)
            <div class="carousel-item active"><img src="{{ asset('images/rooms/' . $room->picture->file_name) }}" class="img-fluid rounded avatar-50 mr-3" alt="image"></div>
            @endif
            @if ($room->image2)
            <div class="carousel-item"><img src="{{ asset('images/rooms/' . $room->image2) }}" class="img-fluid rounded avatar-50 mr-3" alt="image"></div>
            @endif
            @if ($room->image3)
            <div class="carousel-item"><img src="{{ asset('images/rooms/' . $room->image3) }}" class="img-fluid rounded avatar-50 mr-3" alt="image"></div>
            @endif
            @if ($room->image4)
            <div class="carousel-item"><img src="{{ asset('images/rooms/' . $room->image4) }}" class="img-fluid rounded avatar-50 mr-3" alt="image"></div>
            @endif
            @if ($room->image5)
            <div class="carousel-item"><img src="{{ asset('images/rooms/' . $room->image5) }}" class="img-fluid rounded avatar-50 mr-3" alt="image"></div>
            @endif
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
      </div>
      <div class="caption">
        <h3>{{ $room->name }}</h3>
        <h4>{{ $room->roomType->name }}</h4>
        <strong>Status:</strong>
        <div class="status-badge">
          @if ($room->status === 'active')
          <span class="badge bg-warning-light">Active</span>
          @elseif ($room->status === 'maintenance')
          <span class="badge bg-danger-light">Maintenance</span>
          @elseif ($room->status === 'vacancy')
          <span class="badge bg-info-light">Vacancy</span>
          @endif
        </div>
        <p class="purchase-info"><a href="{{ url('/room_detail', $room->id) }}" class="btn btn-primary btn-block text-center" role="button">View Detail</a></p>
      </div>
    </div>
    @endforeach
  </div>
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