@extends('AuthPage.master');
@section('title','Register | Provider');
@section('content')
<body class="light ">
    <div class="wrapper vh-100">
        <div class="row align-items-center h-100">
            <form class="col-lg-3 col-md-4 col-10 mx-auto text-center" action="{{route('provider_register_submit')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="#">
                    <img style="width: 300px; height: 85px;" src="https://i0.wp.com/dentavibe.com/wp-content/uploads/2022/07/Horizontal-Logo-DentaVIBE.png" alt="" srcset="">
                </a>
                <h1 class="h6 mb-3">Sign Up</h1>
                <div class="form-group">
                    <label for="inputEmail" class="sr-only"> </label>
                    <select required name="user_type"type="text" class="form-control form-control-lg" value="{{old('user_type')}}"
                    placeholder="Please select your type" >
                    <option selected="selected" disabled value="">Provider Type</option>
                    <option value="dentist">Dentist</option>
                    <option value="hygentist">Hygentist</option>
                </select>
                        <span class="text-danger">
                            @error('user_type')
                                {{$message}}
                            @enderror
                        </span>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="sr-only">Name</label>
                    <input required name="name" type="text" id="inputEmail" class="form-control form-control-lg" value="{{old('name')}}" placeholder="Your Name" required="" autofocus="">
                        <span class="text-danger">
                            @error('name')
                                {{$message}}
                            @enderror
                        </span>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input required name="email" type="email" id="inputEmail" class="form-control form-control-lg" value="{{old('email')}}"
                        placeholder="Email address" required="" autofocus="">
                        <span class="text-danger">
                            @error('email')
                                {{$message}}
                            @enderror
                        </span>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="sr-only">Phone no.</label>
                    <input required name="mobile" type="text" id="inputEmail" class="form-control form-control-lg" value="{{old('mobile')}}" placeholder="Your Phone no" required="" autofocus="">
                        <span class="text-danger">
                            @error('mobile')
                                {{$message}}
                            @enderror
                        </span>
                </div>              
                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" class="form-control form-control-lg"
                        placeholder="Password" name="password" required="">
                        <span class="text-danger">
                            @error('password')
                                {{$message}}
                            @enderror
                        </span>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Confirm Password</label>
                    <input type="password" id="inputPassword" class="form-control form-control-lg"
                        placeholder="Re-Enter Password" name="password_confirmation" required="">
                        <span class="text-danger">
                            @error('password_confirmation')
                                {{$message}}
                            @enderror
                        </span>
                </div>
                @if (session('error'))
                <div class="alert alert-danger alert-dismissible show">       {{ session('error') }} 
                </div>
                @endif
                <div class="form-group">
                    <label for="inputEmail" class="sr-only">Profile Photo </label>
                    <input required name="image" type="file" id="inputEmail" class="form-control form-control-lg" value="{{old('image')}}"
                        placeholder="Profile Photo"  autofocus="">
                        <span class="text-danger">
                            @error('image')
                                {{$message}}
                            @enderror
                        </span>
                </div>
                {{-- <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Stay logged in </label>
                </div> --}}
                <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
                <br>
                    <a href="{{url('/providers')}}"><p class="mt-5 mb-3 text-muted">Login</p></a>
                <br>
                <p class="mt-5 mb-3 text-muted">Strix Digital © 2020</p>
            </form>
        </div>
    </div>
@endsection