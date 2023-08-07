<link rel="stylesheet" href="{{ asset('frontend/roomdeail.css') }}" />

@extends('frontend.master')

@section('content')
</br>
<div class="card-wrapper">
    <div class="card">
        <!-- card left -->
        <div class="product-imgs">
            <div class="img-display">
                <div class="img-showcase">
                    <p>@include('errors.note')</p>
                    @if ($room->image1)
                    <img src="{{ asset('images/rooms/' . $room->image1) }}" alt="shoe image">
                    @endif
                    @if ($room->image2)
                    <img src="{{ asset('images/rooms/' . $room->image2) }}" alt="shoe image">
                    @endif
                    @if ($room->image3)
                    <img src="{{ asset('images/rooms/' . $room->image3) }}" alt="shoe image">
                    @endif
                    @if ($room->image4)
                    <img src="{{ asset('images/rooms/' . $room->image4) }}" alt="shoe image">
                    @endif
                    @if ($room->image5)
                    <img src="{{ asset('images/rooms/' . $room->image5) }}" alt="shoe image">
                    @endif
                </div>
            </div>
            <div class="img-select">
                @if ($room->image1)
                <div class="img-item">
                    <a href="#" data-id="1">
                        <img src="{{ asset('images/rooms/' . $room->image1) }}" alt="shoe image" style="width:120px;height:100px">
                    </a>
                </div>
                @endif
                @if ($room->image2)
                <div class="img-item">
                    <a href="#" data-id="2">
                        <img src="{{ asset('images/rooms/' . $room->image2) }}" alt="shoe image" style="width:120px;height:100px">
                    </a>
                </div>
                @endif
                @if ($room->image3)
                <div class="img-item">
                    <a href="#" data-id="3">
                        <img src="{{ asset('images/rooms/' . $room->image3) }}" alt="shoe image" style="width:120px;height:100px">
                    </a>
                </div>
                @endif
                @if ($room->image4)
                <div class="img-item">
                    <a href="#" data-id="4">
                        <img src="{{ asset('images/rooms/' . $room->image4) }}" alt="shoe image" style="width:120px;height:100px">
                    </a>
                </div>
                @endif
                @if ($room->image5)
                <div class="img-item">
                    <a href="#" data-id="5">
                        <img src="{{ asset('images/rooms/' . $room->image5) }}" alt="shoe image" style="width:120px;height:100px">
                    </a>
                </div>
                @endif
            </div>
        </div>
        <!-- card right -->
        <div class="product-content">
            <h2 class="product-title">{{ $room->name }}</h2>

            <?php
            $rating = rand(3, 5);
            $commentCount = rand(10, 50);
            ?>

            <a href="#" class="product-link">Visit hotel</a>
            <div class="product-rating">
                <?php for ($i = 1; $i <= 5; $i++) : ?>
                    <?php if ($i <= $rating) : ?>
                        <i class="fa fa-star"></i>
                    <?php elseif ($i - $rating === 0.5) : ?>
                        <i class="fa fa-star-half-alt"></i>
                    <?php else : ?>
                        <i class="far fa-star"></i>
                    <?php endif; ?>
                <?php endfor; ?>
                <span><?php echo $rating; ?>(<?php echo $commentCount; ?>)</span>
            </div>

            <h2>Calendars other customers have orders</h2>
            @if ($orders->isEmpty())
                <p>There are no other reservations.</p>
            @else
                <ul>
                    @foreach ($orders as $order)
                        <li>{{ date('D, h:i A d/m/Y', strtotime($order->check_in_date)) }} - {{ date('D, h:i A d/m/Y', strtotime($order->check_out_date)) }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="product-price">
                <p class="new-price"><p style="color: #000">Price:</p> {{ $room->price }} $/h </p>
            </div>

            <div class="product-detail">
                <h2>Room's information:</h2>
                <ul>
                    <li>Room Type: {{ $room->roomType->name }}</li>
                    <li>Size: {{ $room->size }} m²</li>
                    <li>Description: {{ $room->description }}</li>
                </ul>
            </div>
            <div class="purchase-info">
                @if (Auth::check())
                    <button type="button" class="btn">
                        <a href="{{ route('order', ['room_id' => $room->id, 'user_id' => $user->id]) }}" style="color: #000;">Order</a>
                    </button> 
            @else
            <button type="button" class="btn">
              <a href="{{asset('/user/login')}}" style="color: #000;">Login to Order</a>
          </button>
            @endif
            <button type="button" class="btn" onclick="window.history.back()">Back</button>
          </div>
        </div>
    </div>
</div>
</br>
<script>
    const imgs = document.querySelectorAll('.img-select a');
    const imgBtns = [...imgs];
    let imgId = 1;

    imgBtns.forEach((imgItem) => {
        imgItem.addEventListener('click', (event) => {
            event.preventDefault();
            imgId = imgItem.dataset.id;
            slideImage();
        });
    });

    function slideImage() {
        const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

        document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
    }

    window.addEventListener('resize', slideImage);
</script>
@endsection
