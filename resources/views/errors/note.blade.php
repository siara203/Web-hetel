@if(Session::has('error'))
    <p class="alert alert-danger" style="padding: 10px; border-radius: 4px; margin-bottom: 10px;">
        <i class="fa fa-exclamation-circle" style="margin-right: 5px;"></i>{{ Session::get('error') }}
    </p>
@endif

@foreach($errors->all() as $error)
    <p class="alert alert-danger" style="padding: 10px; border-radius: 4px; margin-bottom: 10px;">
        <i class="fa fa-exclamation-circle" style="margin-right: 5px;"></i>{{ $error }}
    </p>
@endforeach

@if (session('success'))
    <div class="alert alert-success" style="padding: 10px; border-radius: 4px; margin-bottom: 10px;">
        <i class="fa fa-check-circle" style="margin-right: 5px;"></i>{{ session('success') }}
    </div>
@endif
