
@extends('frontend.master')

@section('content')
<div class="row">

  <div class="col-lg-12 margin-tb">

      <div class="pull-left">

          <h2> Show Rooms</h2>

      </div>

      <div class="pull-right">

          <a class="btn btn-primary" href="{{ route('frontend.rooms') }}"> Back</a>

      </div>

  </div>

</div>

<div class="row">

  <div class="col-xs-12 col-sm-12 col-md-12">

      <div class="form-group">

          <strong>Name:</strong>

          {{ $room->name }}

      </div>

  </div>


  <div class="col-xs-12 col-sm-12 col-md-12">

      <div class="form-group">

          <strong>Image:</strong>
         
          @foreach ($product->image as $image)
              <img src="{{ asset('image/rooms/' . $image->image) }}" alt="" style="margin: 15px" height=150
                  width=250>
          @endforeach




      </div>

  </div>




</div>
@stop