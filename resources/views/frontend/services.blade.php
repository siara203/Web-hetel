<link rel="stylesheet" href="{{ asset('backend/room.css') }}" />

@extends('frontend.master')

@section('content')

<div class="container">

    <center>
        <h2>services</h2>
    </center>


<!-- form -->

  <div class="services-group">
  <div class="row-index">
    @foreach($services as $service)
    <div class="col-xs-18 col-sm-6 col-md-4-index" >
      <div class="img_thumbnail productlist-index">
        <div id="carousel-{{ $service->id }}" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @if ($service->image) <li data-target="#carousel-{{ $service->id }}" data-slide-to="0" class="active"></li> @endif
            </ol>
            <div class="carousel-inner">
                @if ($service->image)
                <div class="carousel-item active"><img src="{{ asset('images/services/' . $service->image) }}" class="img-fluid rounded avatar-50 mr-3" alt="image"></div>
                @endif
            </div>
            <a class="carousel-control-prev" href="#carousel-{{ $service->id }}" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-{{ $service->id }}" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
        </div>
      </div>
    <center>
      <div class="caption">
        <h3>{{ $service->name }}</h3>
        <h4> price:  {{ $service->price }} $ </h4>
        
      </div>
    </center>
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
                     <li><a href="#">»</a></li>
                     </ul>
                     </div>


</div>
@stop

