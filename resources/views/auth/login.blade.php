<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSS only -->
    <link rel="stylesheet" href="{{ asset('css/style-login.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    {{-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}
    <!------ Include the above in your HEAD tag ---------->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <title>Đăng nhập</title>
</head>

{{-- <body style="background: #d5e3e4">

    <div class="container">
        <img src="{{ asset('img/mtac-system.png') }}" alt="" id="logo" />
        <div class="formLogin">
            <div class="row">
                <form form method="POST" action="{{ route('getLogin') }}" class="col-md-4">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Tên Đăng Nhập</label>
                        <input type="text" id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus />
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật Khẩu</label>
                        <input type="password" id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password" />
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <div class="mb-3 form-check">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="remember" name="remember"
                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">Nhớ mật khẩu?</label>
                            </div>
                        </div>
                    </div>

                    @if (session('wrong_account'))
                        <div class="mb-3">
                            <span style="color: red">{{ session('wrong_account') }} </span>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary w-100">ĐĂNG NHẬP</button>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Quên mật khẩu?') }}
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>

</body> --}}
<style>
    .login-block {
        background: #de6262;
        background: url("./public/img/bg-login.jpg");
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        float: left;
        width: 100%;
        padding: 100px 0;
        height: 100vh;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .banner-sec {
        background: url('./public/img/hhh1.jpg') no-repeat left bottom;
        background-size: cover;
        min-height: 500px;
        border-radius: 0 10px 10px 0;
        padding: 0;
    }

</style>

<body>
    <section class="login-block" style="min-height: 386px">
        <div class="container">
            <div class="row">
                <div class="col-md-4 login-sec" style="min-height: 486px;">
                    <h2 class="text-center">Đăng Nhập</h2>



                    <form method="POST" action="{{ route('getLogin') }}" class="login-form">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="text-uppercase">Email Đăng Nhập</label>
                            <input type="text" class="form-control" id="email" type="email"
                                @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required
                                autocomplete="email" autofocus placeholder="Email..">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-uppercase">Mật Khẩu</label>
                            <input type="password" class="form-control" id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="Mật Khẩu..">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @if (session('wrong_account'))
                            <div class="mb-3">
                                <span style="color: red">{{ session('wrong_account') }} </span>
                            </div>
                        @endif

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" value="remember" name="remember"
                                id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" class="form-check-label">
                                Nhớ mật khẩu?
                            </label>
                        </div>
                        <div class="submit">
                            <button type="submit" class="btn btn-login float-right btn-danger">ĐĂNG NHẬP</button>
                        </div>
                        @if (Route::has('password.request'))
                            <div class="mt-5">
                                <a class="btn btn-link d-block" href="{{ route('password.request') }}">
                                    {{ __('Quên mật khẩu?') }}
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
                <div class="col-md-8 banner-sec">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                        <div class="carousel-inner" role="listbox">
                            {{-- <img class="d-block img-fluid"
                                    src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide"> --}}
                        </div>

                    </div>
                </div>
            </div>
    </section>
</body>


</html>
