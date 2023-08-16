<link rel="stylesheet" href="{{ asset('backend/roomdeail.css') }}" />

@extends('frontend.master')

@section('content')
</br>
<div class = "card-wrapper">
    <div class = "card">
      <!-- card left -->
      <div class = "product-imgs">
        <div class = "img-display">
          <div class = "img-showcase">
            <p>@include('errors.note')</p>
            @if ($service->image)
            <img src="{{ asset('images/services/' . $service->image) }}" alt="shoe image">
            @endif
          </div>
        </div>
      </div>
      <div class="product-content">
          <h2 class="product-title">{{ $service->name }}</h2>
          <?php
          $rating = rand(3, 5);
          $commentCount = rand(10, 50);
          ?>
    
          <div class="product-price">
              <p class="new-price"><p style="color: #000">Price:</p> {{ $service->price }} $ </p>
          </div>
          <div class="product-detail">
              <h2> information:</h2>
              <ul>
                  <li>Description: {{ $service->description }}</li>
              </ul>
          </div>
          <div class="purchase-info">
              @if (Auth::check())              
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