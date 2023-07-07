<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SDN Hotel | Registration</title>
    <link rel="stylesheet" href="{{ asset('assets/login.css') }}">
    <link rel="shortcut icon" href="{{ asset('adm/images/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Unicons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  </head>
  <body>
        <!-- loader Start -->
        <div id="loading">
            <div id="loading-center">
            </div>
      </div>
      <!-- loader END -->
   
  <div class="main">

<!-- Sign up form -->
<section class="signup">
    <div class="container">
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title">Sign up</h2>
                <h4 style="text-align: center;">@include('errors.note')</h4>
                <h4 id="error-message" style="text-align: center; color: red;"></h4>
                <form action="{{ route('register') }}" method="POST" class="register-form" id="register-form" onsubmit="return validateForm();">

                    <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="name" id="name" placeholder="Your Name" required/>
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" name="email" id="email" placeholder="Your Email" required/>
                    </div>
                    <div class="form-group">
                        <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                        <input type="phone" name="phone" id="phone" placeholder="Your Phone" required/>
                    </div>
                    <div class="form-group">
                        <label for="address"><i class="zmdi zmdi-city"></i></label>
                        <input type="address" name="address" id="address" placeholder="Your Address" required/>
                    </div>
                    <div class="form-group">
                        <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="pass" id="pass" placeholder="Password" required/>
                    </div>
                    <div class="form-group">
                        <label for="re_pass"><i class="zmdi zmdi-lock-outline"></i></label>
                        <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" required/>
                    </div>
                    <div>
                        <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" required/>
                        <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="{{ url('terms-of-service') }}" class="term-service">Terms of service</a></label>
                    </div>
    

                    <div class="form-group form-button">
                        <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                    </div>
                    {{ csrf_field()}}
                </form>

            </div>
            <div class="signup-image">
                <figure><img src=" {{ asset('images/register.jpeg') }}" style="width: 287px;" alt="sing up image"></figure>
                <a href= "{{asset('/user/login')}}" class="signup-image-link">I am already member</a>
            </div>
        </div>
    </div>
</section>
    <script src="{{ asset('assets/login.js') }}"></script>
    <script>
        document.getElementById("register-form").addEventListener("submit", function(event) {
            var checkbox = document.getElementById("agree-term");
            var errorMessage = document.getElementById("error-message");
            if (!checkbox.checked) {
                errorMessage.textContent = "Please accept the terms of service.";
                event.preventDefault(); 
            } else {
                errorMessage.textContent = ""; 
            }
        });
    </script>
  </body>
</html>
