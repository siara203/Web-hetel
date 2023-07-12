<style>
  .rooms-group {
  margin-bottom: 20px;
}

.row-index {
  display: flex;
  flex-wrap: wrap;
}

.col-xs-18 {
  width: 100%;
}

@media (min-width: 576px) {
  .col-sm-6 {
    flex: 0 0 50%;
    max-width: 50%;
  }
}

@media (min-width: 768px) {
  .col-md-4-index {
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
  }
}

.img_thumbnail {
  position: relative;
}

.carousel-inner {
  position: relative;
  width: 100%;
  height: 0;
  padding-bottom: 75%;
  overflow: hidden;
}

.carousel-inner .carousel-item {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

.carousel-inner .carousel-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.carousel-control-prev,
.carousel-control-next {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background-color: rgba(0, 0, 0, 0.5);
  color: #fff;
  text-align: center;
  font-size: 20px;
  line-height: 30px;
  cursor: pointer;
}

.carousel-control-prev {
  left: 10px;
}

.carousel-control-next {
  right: 10px;
}

.caption {
  padding: 10px;
}

.caption h3 {
  margin-top: 0;
  text-align: center;
  font-weight: bold;
  font-size: 18px;
  color: black;
}
.caption h4 {
  text-align: center;
}

.status-badge {
  margin-top: 10px;
  color: white;
}

.status-badge span {
  display: inline-block;
  padding: 5px 10px;
  border-radius: 4px;
}

.status-badge .bg-warning-light {
  background-color: rgb(112, 239, 83);
  color: white;
}

.status-badge .bg-danger-light {
  background-color: rgb(247, 70, 70);
  color: white;
}

.status-badge .bg-info-light {
  background-color: rgb(248, 248, 56);
  color: black;
}

.purchase-info {
  margin-top: 10px;
}

</style>
@extends('frontend.master')

@section('content')

<div class="container">

<h2>Rooms</h2>


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
        <p class="purchase-info"><a href="" class="btn btn-primary btn-block text-center" role="button">Order</a></p>
        <p class="purchase-info"><a href="{{ url('/details', $room->id) }}" class="btn btn-primary btn-block text-center" role="button">View Detail</a></p>
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