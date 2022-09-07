<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Vali-Teach | Login</title>

    <link rel="stylesheet" href="{{ asset('./css/backend.css?v=1.0.0') }}" />
    <link rel="stylesheet" href="{{ asset('./vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('./vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('./vendor/remixicon/fonts/remixicon.css"') }}" />
</head>
  <body class=" ">
    <!-- loader Start -->
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
    <!-- loader END -->
    
      <div class="wrapper">
       <section class="login-content">
         <div class="container h-100">
            <div class="row justify-content-center align-items-center height-self-center">
               <div class="col-md-4 col-sm-12 col-12 align-self-center">
                  <div class="sign-user_card">   
                     <div class="logo-detail">            
                           <div class="d-flex align-items-center"><img src="{{ asset('images/logo.png') }}"
        class="img-fluid rounded-normal light-logo logo" alt="logo">
    <h4 class="logo-title ml-3">Vali-Teach</h4>
    </div>
    </div>
    <h3 class="mb-2">Login</h3>
    <p>Tizimga kirish uchun email va parolni kiriting</p>
    @if ($errors->any())
    <div class="alert alert-danger pt-4 mt-3">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="floating-label form-group">
                    <input class="floating-input form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" name="email" type="email" placeholder=" ">
                    <label>Email</label>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="floating-label form-group">
                    <input class="floating-input form-control @error('password') is-invalid @enderror" name="password"
                        type="password" placeholder=" ">
                    <label>Parol</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Sign In</button>
    </form>
    </div>
    </div>
    </div>
    </div>
    </section>
    </div>
    <script src="{{ asset(' ./js/jquery-3.6.0.min.js') }}">
    </script>
    <script src="{{ asset('./js/backend-bundle.min.js') }}"></script>
    <script src="{{ asset('./js/app.js') }}"></script>
    </body>

</html>