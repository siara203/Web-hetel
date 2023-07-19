<link rel="stylesheet" href="{{ asset('frontend/order.css') }}" />

@extends('frontend.master')

@section('content')
<h2>Order Room {{ $room->name }}</h2>
@if (session('success'))

<p>@include('errors.note')</p>
@endif
<form action="{{ route('postorder', ['room_id' => $room->id, 'user_id' => $user->id]) }}" method="POST">
    @csrf
    <div class="col-md-6">
    <div class="form-group">
        <label for="check_in_date">Check-in Date</label>
        <input type="datetime-local" name="check_in_date" class="form-control" required>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="check_out_date">Check-out Date</label>
        <input type="datetime-local" name="check_out_date" class="form-control" required>
    </div>
</div>
    <div class="form-group">
        <h4>Services:</h4>
        @foreach($services as $service)
            <div class="form-check">
                <input type="checkbox" name="service_id[]" value="{{ $service->id }}" id="service_{{ $service->id }}">
                <label for="service_{{ $service->id }}">{{ $service->name }}</label>
                <input type="number" name="quantity[]" min="0" value="0">
            </div>
        @endforeach
    </div>
    <div class="col-md-12">
            <label for="description">Description</label>
        <div class="form-group">
            <textarea name="description" id="description" rows="4" style="width: 90%;"></textarea>
        </div>
    </div>
    
    <button class="submitorder" type="submit">Submit Order</button>
</form>
</br>
@endsection
