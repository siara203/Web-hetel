@extends('frontend.master')

@section('content')
<div class="rooms-group">
  <div class="row-index">
@foreach($rooms as $item)
<div class="col-md-3 col-sm-6 col-12">
    <div class="card card-product mb-3">
      <img class="card-img-top" src="{{ asset('image/rooms/'.$item->image) }}" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">{{ $item->name }}</h5>
        <p class="card-text">{{ $item->price }}</p>
        <a href="{{ url('room_detail',$item->id) }}" class="btn btn-primary">Details</a>
      </div>
    </div>
</div>  
</div>
</div>
@endforeach
@stop