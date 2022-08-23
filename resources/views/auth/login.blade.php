<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AdminPanel | Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/tooplate.css') }}" />
</head>

<body class="bg03">
    <div class="container">
        <div class="row tm-mt-big">
            <div class="col-12 mx-auto tm-login-col">
                <div class="bg-white tm-block">
                    <div class="row">
                        <div class="col-12 text-center">
                            <i class="fas fa-3x fa-lock tm-site-icon text-center"></i>
                            <h2 class="tm-block-title mt-3">Login</h2>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <form action="{{ route('login') }}" method="post" class="tm-login-form">
                                @csrf
                                <div class="input-group">
                                    <label for="email" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Email:</label>
                                    <input name="email" type="email" placeholder="Emailni kiriting..."
                                        class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7 @error('email') is-invalid @enderror"
                                        id="email" value="{{ old('email') }}" required>
                                </div>
                                <div class="input-group mt-3">
                                    <label for="password"
                                        class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Parol:</label>
                                    <input name="password" placeholder="Parolni kiriting..." type="password"
                                        class="form-control validate @error('password') is-invalid @enderror"
                                        id="password" required>
                                </div>
                                <div class="input-group mt-3">
                                    <button type="submit" class="btn btn-primary d-inline-block mx-auto">Kirish</button>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger pt-4 mt-3">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</html>
