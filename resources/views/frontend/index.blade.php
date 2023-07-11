
@extends('frontend.master')

@section('content')

<!-- banner -->
<div class="banner">    	   
<img src="{{ asset('images/photos/banner.jpg') }}" class="img-responsive" alt="slide">
    <div class="welcome-message">
        <div class="wrap-info">
            <div class="information">
                <h1  class="animated fadeInDown">SDN Hotel</h1>
                <p class="animated fadeInUp">Most luxurious hotel of asia with the royal treatments and excellent customer service.</p>                
            </div>
            <a href="#information" class="arrow-nav scroll wowload fadeInDownBig"><i class="fa fa-angle-down"></i></a>
        </div>
    </div>
</div>
<!-- banner-->


<!-- reservation-information -->
<div id="information" class="spacer reserve-info ">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-md-8">
                <div class="embed-responsive embed-responsive-16by9 wowload fadeInLeft">
                    <iframe  class="embed-responsive-item" src="//player.vimeo.com/video/55057393?title=0" width="100%" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen>
                    </iframe>
                </div>
            </div>
        <div class="col-sm-5 col-md-4">
            </br></br>
            <div class="feature">        
                <h4><i class="fa fa-home"></i> Comfortable Rooms</h4>
                <p>Relax and unwind in our spacious and comfortable rooms designed for your ultimate comfort.</p>
            </div>
            <hr>
            <div class="feature">
                <h4><i class="fa fa-cutlery"></i> Delicious Dining</h4>
                <p>Indulge in a culinary journey with our exquisite menu and a variety of dining options.</p>
            </div>  
            <hr>
            <div class="feature">
                <h4><i class="fa fa-map-marker" aria-hidden="true"></i> Convenient Location</h4>
                <p>Located in the heart of the city, our hotel offers easy access to popular attractions and amenities.</p>
            </div>
            <hr></br></br></br> 
        </div>
        <!-- Services Section -->
        <div id="services" class="spacer">
            <div class="container">
                <h2>Our Services</h2>
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="service">
                            <h4><i class="fa fa-wifi"></i> Free Wi-Fi</h4>
                            <p>Stay connected with our high-speed Wi-Fi throughout the hotel premises.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="service">
                            <h4><i class="fa fa-car" aria-hidden="true"></i> Parking</h4>
                            <p>Convenient and secure parking facilities available for our guests.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
  <!-- Services Section -->
</div>
</div>
<!-- reservation-information -->
<!-- services -->
<div class="spacer services wowload fadeInUp">
<div class="container">
<div class="row">
    <div class="col-sm-4">
        <!-- RoomCarousel -->
        <div id="RoomCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active"><img src="{{ asset('images/photos/8.jpg') }}" class="img-responsive" alt="slide"></div>
                <div class="item height-full"><img src="{{ asset('images/photos/9.jpg') }}" class="img-responsive" alt="slide"></div>
                <div class="item height-full"><img src="{{ asset('images/photos/10.jpg') }}" class="img-responsive" alt="slide"></div>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#RoomCarousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
            <a class="right carousel-control" href="#RoomCarousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
        </div>
        <!-- RoomCarousel -->
        <div class="caption">Rooms<a href="{{ url('/rooms') }}" class="pull-right"><i class="fa fa-edit"></i></a></div>
    </div>

    <div class="col-sm-4">
        <!-- TourCarousel -->
        <div id="TourCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active"><img src="{{ asset('images/photos/6.jpg') }}" class="img-responsive" alt="slide"></div>
                <div class="item height-full"><img src="{{ asset('images/photos/3.jpg') }}" class="img-responsive" alt="slide"></div>
                <div class="item height-full"><img src="{{ asset('images/photos/4.jpg') }}" class="img-responsive" alt="slide"></div>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#TourCarousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
            <a class="right carousel-control" href="#TourCarousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
        </div>
        <!-- TourCarousel -->
        <div class="caption">Tour Packages<a href="" class="pull-right"><i class="fa fa-edit"></i></a></div>
    </div>

    <div class="col-sm-4">
        <!-- FoodCarousel -->
        <div id="FoodCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active"><img src="{{ asset('images/photos/1.jpg') }}" class="img-responsive" alt="slide"></div>
                <div class="item height-full"><img src="{{ asset('images/photos/2.jpg') }}" class="img-responsive" alt="slide"></div>
                <div class="item height-full"><img src="{{ asset('images/photos/5.jpg') }}" class="img-responsive" alt="slide"></div>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#FoodCarousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
            <a class="right carousel-control" href="#FoodCarousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
        </div>
        <!-- FoodCarousel -->
        <div class="caption">Services<a href="{{ url('/services') }}" class="pull-right"><i class="fa fa-edit"></i></a></div>
    </div>
</div>

</div>
</div>
<!-- services -->


@stop
