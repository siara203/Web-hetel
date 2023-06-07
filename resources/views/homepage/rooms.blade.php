@extends('homepage.master')

@section('content')

<div class="container">

<h2>Rooms</h2>


<!-- form -->

<div class="row">
      <div class="col-sm-6 wowload fadeInUp">
        <div class="rooms">
          <img src="images/photos/8.jpg" class="img-responsive">
          <div class="info">
            <h3>Phòng sang trọng</h3>
            <p>...</p>
            <a href="{{ url('/details') }}" class="btn btn-default">Xem chi tiết</a>
          </div>
        </div>
      </div>
      <div class="col-sm-6 wowload fadeInUp">
        <div class="rooms">
          <img src="images/photos/9.jpg" class="img-responsive">
          <div class="info">
            <h3>Phòng sang trọng</h3>
            <p>...</p>
            <a href="{{ url('/details') }}" class="btn btn-default">Xem chi tiết</a>
          </div>
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