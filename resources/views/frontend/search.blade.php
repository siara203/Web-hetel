<link rel="stylesheet" href="{{ asset('frontend/search.css') }}" />
@extends('frontend.master')

@section('content')
<div class="rooms-group">
  <div class="row-index">
    @foreach($rooms as $item)
    <div class="col-md-3 col-sm-6 col-12">
      <div class="card card-product mb-3">
        <div class="img_thumbnail productlist-index">
          <div id="carousel-{{ $item->id }}" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              @if ($item->image1) <li data-target="#carousel-{{ $item->id }}" data-slide-to="0" class="active"></li> @endif
              @if ($item->image2) <li data-target="#carousel-{{ $item->id }}" data-slide-to="1"></li> @endif
              @if ($item->image3) <li data-target="#carousel-{{ $item->id }}" data-slide-to="2"></li> @endif
              @if ($item->image4) <li data-target="#carousel-{{ $item->id }}" data-slide-to="3"></li> @endif
              @if ($item->image5) <li data-target="#carousel-{{ $item->id }}" data-slide-to="4"></li> @endif
            </ol>
            <div class="carousel-inner">
              @if ($item->image1)
              <div class="carousel-item active"><img src="{{ asset('images/rooms/' . $item->image1) }}" class="img-fluid rounded avatar-50 mr-3" alt="image"></div>
              @endif
              @if ($item->image2)
              <div class="carousel-item"><img src="{{ asset('images/rooms/' . $item->image2) }}" class="img-fluid rounded avatar-50 mr-3" alt="image"></div>
              @endif
              @if ($item->image3)
              <div class="carousel-item"><img src="{{ asset('images/rooms/' . $item->image3) }}" class="img-fluid rounded avatar-50 mr-3" alt="image"></div>
              @endif
              @if ($item->image4)
              <div class="carousel-item"><img src="{{ asset('images/rooms/' . $item->image4) }}" class="img-fluid rounded avatar-50 mr-3" alt="image"></div>
              @endif
              @if ($item->image5)
              <div class="carousel-item"><img src="{{ asset('images/rooms/' . $item->image5) }}" class="img-fluid rounded avatar-50 mr-3" alt="image"></div>
              @endif
            </div>
            <a class="carousel-control-prev" href="#carousel-{{ $item->id }}" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-{{ $item->id }}" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title">{{ $item->name }}</h5>
          <h4>{{ $item->roomType->name }}</h4>
          <strong>Status:</strong>
          <div class="status-badge">
            @if ($item->status === 'active')
            <span class="badge bg-warning-light">Active</span>
            @elseif ($item->status === 'maintenance')
            <span class="badge bg-danger-light">Maintenance</span>
            @elseif ($item->status === 'vacancy')
            <span class="badge bg-info-light">Vacancy</span>
            @endif
          </div>
          <p class="purchase-info"><a href="{{ url('/room_detail', $item->id) }}" class="btn btn-primary btn-block text-center" role="button">View Detail</a></p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@stop
<!-- Bootstrap scripts (jQuery is required) -->
