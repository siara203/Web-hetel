@extends('frontend.master')

@section('content')
<div class="container">

       <h1 class="title">Services</h1>
       <div class="row gallery">
        <div class="col-sm-4 wowload fadeInUp">
            <a>Luxury Rooms</a>
            <a href="{{ asset('images/photos/1.jpg') }}" title="Luxury Rooms" class="gallery-image" data-gallery>
                <img src="{{ asset('images/photos/1.jpg') }}" class="img-responsive">
            </a>
        </div>
        <div class="col-sm-4 wowload fadeInUp">
            <a>Restaurants and Bars</a>
            <a href="{{ asset('images/photos/2.jpg') }}" title="Coffee" class="gallery-image" data-gallery>
                <img src="{{ asset('images/photos/2.jpg') }}" class="img-responsive">
            </a>
        </div>
        <div class="col-sm-4 wowload fadeInUp">
            <a>24/7 Room Service</a>
            <a href="{{ asset('images/photos/3.jpg') }}" title="Travel" class="gallery-image" data-gallery>
                <img src="{{ asset('images/photos/3.jpg') }}" class="img-responsive">
            </a>
        </div>
        <div class="col-sm-4 wowload fadeInUp">
            <a>Fitness Center and Spa</a>
            <a href="{{ asset('images/photos/4.jpg') }}" title="Adventure" class="gallery-image" data-gallery>
                <img src="{{ asset('images/photos/4.jpg') }}" class="img-responsive">
            </a>
        </div>
        <div class="col-sm-4 wowload fadeInUp">
            <a>Swimming Pool</a>
            <a href="{{ asset('images/photos/5.jpg') }}" title="Fruits" class="gallery-image" data-gallery>
                <img src="{{ asset('images/photos/5.jpg') }}" class="img-responsive">
            </a>
        </div>
        <div class="col-sm-4 wowload fadeInUp">
            <a>Conference and Event Services</a>
            <a href="{{ asset('images/photos/6.jpg') }}" title="Summer" class="gallery-image" data-gallery>
                <img src="{{ asset('images/photos/6.jpg') }}" class="img-responsive">
            </a>
        </div>
        <div class="col-sm-4 wowload fadeInUp">
            <a>Shuttle and Car Rental Services</a>
            <a href="{{ asset('images/photos/7.jpg') }}" title="Bathroom" class="gallery-image" data-gallery>
                <img src="{{ asset('images/photos/7.jpg') }}" class="img-responsive">
            </a>
        </div>
        <div class="col-sm-4 wowload fadeInUp">
            <a>Special Assistance Services</a>
            <a href="{{ asset('images/photos/8.jpg') }}" title="Rooms" class="gallery-image" data-gallery>
                <img src="{{ asset('images/photos/8.jpg') }}" class="img-responsive">
            </a>
        </div>
        <div class="col-sm-4 wowload fadeInUp">
            <a>Concierge Services</a>
            <a href="{{ asset('images/photos/9.jpg') }}" title="Big Room" class="gallery-image" data-gallery>
                <img src="{{ asset('images/photos/9.jpg') }}" class="img-responsive">
            </a>
        </div>
</div>

</div>
@stop