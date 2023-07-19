@extends('frontend.master')

@section('content')
<style>
    /* Style for the heading */
h2 {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 20px;
}

/* Style for the success message */
p {
  color: green;
  font-size: 16px;
  margin-bottom: 10px;
}

/* Style for the form container */
form {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
}

/* Style for the form input fields and labels */
.form-group {
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  font-weight: bold;
}

.form-control {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

/* Style for the Services section */
h4 {
  font-size: 20px;
  font-weight: bold;
  margin-bottom: 10px;
}

.form-check {
  margin-bottom: 10px;
}

.form-check input[type="checkbox"] {
  margin-right: 5px;
}

/* Style for the Description textarea */
#description {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical; /* Allows vertical resizing of the textarea */
}

/* Style for the Submit button */
button[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
}

/* Add some spacing around the Submit button */
button[type="submit"] {
  margin-top: 20px;
}
</style>
    <h2>Order Form</h2>
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
        
        <button type="submit">Submit Order</button>
    </form>
@endsection
