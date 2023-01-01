@extends('AuthPage.master');
@section('title', 'Login | clinic');
@section('content')

    <body class="light ">
        <div class="wrapper vh-100">
            <div class="row align-items-center h-100">
                <form action="{{ route('clinic_login_submit') }}" method="POST"
                    class="col-lg-3 col-md-4 col-10 mx-auto text-center">
                    @csrf
                    <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
                        <img style="width: 300px; height: 85px;" src="https://i0.wp.com/dentavibe.com/wp-content/uploads/2022/07/Horizontal-Logo-DentaVIBE.png" alt="" srcset="">
                    </a>
                    <h1 class="h6 mb-3">Sign in</h1>
                    <div class="form-group">
                        <label for="inputEmail" class="sr-only">Email address</label>
                        <input name="email" type="email" id="inputEmail" class="form-control form-control-lg"
                            placeholder="Email address" required="" autofocus="">
                    </div>
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible show"> {{session('error')}}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="password" id="inputPassword" class="form-control form-control-lg"
                            placeholder="Password" name="password" required="">
                    </div>
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Stay logged in </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Login</button>
                    <br>
                    <a href="{{route('clinic_register')}}">
                        <p class="mt-5 mb-3 text-muted">Register</p>
                    </a><br>
                    <p class="mt-5 mb-3 text-muted">Strix Digital © 2020</p>
                </form>
            </div>
        </div>
    @endsection
