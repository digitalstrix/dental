@extends('users.layouts.master');
@section('title', 'User Profile');
@section('content');

    <body class="vertical  light  ">
        <div class="wrapper">
            <main role="main" class="main-content">
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <a href="{{ route('user_dashboard') }}">
                            <button type="button" class="btn btn-primary">View Dashboard</button>
                        </a>
                        <div class="card-header">
                            <strong class="card-title">Edit {{ session('name') }}</strong>
                        </div>
                        {{-- {{dd($user);}} --}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" action="{{ route('user_edit_submit') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Email</label>
                                            <input hidden required type="text" id="simpleinput" class="form-control"
                                                value="{{ $user->id }}" name="id">
                                            <input disabled required type="text" id="simpleinput" class="form-control"
                                                value="{{ $user->email }}" name="email">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Name</label>
                                            <input type="text" id="simpleinput" class="form-control"
                                                value="{{ $user->name }}" name="name">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Mobile</label>
                                            <input type="text" id="simpleinput" class="form-control"
                                                value="{{ $user->mobile }}" name="mobile">
                                        </div>
                                        <div class="form-group mb-3">
                                           
                                            <label for="simpleinput">Profile Image</label>
                                            <input type="file" id="simpleinput" class="form-control" value=""
                                                name="profile">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Password</label>
                                            <input type="password" id="simpleinput" class="form-control" value=""
                                                name="password">
                                        </div>

                                        <div class="form-group mb-3">
                                            <div class="form-group">
                                                <label for="address_address">Address</label>
                                                <input required type="text" id="address-input"
                                                    value="<?php echo $user['address']; ?>" name="address"
                                                    class="form-control map-input">
                                                <input required type="hidden" name="latitude" id="address-latitude"
                                                    value="<?php echo $user['latitude']; ?>" />
                                                <input required type="hidden" name="longitude" id="address-longitude"
                                                    value="<?php echo $user['longitude']; ?>" />
                                            </div>
                                            <div id="address-map-container" style="width:100%;height:400px; ">
                                                <div style="width: 100%; height: 100%" id="address-map"></div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">

                                            <input type="submit" id="example-palaceholder" class="btn btn-primary"
                                                value="Update">
                                        </div>
                                </div> <!-- /.col -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .container-fluid -->

                <script
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPOdyees3JKBv9EL4o7Za1jyrZofFr8Mg&libraries=places&callback=initialize"
                    async defer></script>
                <script src="/js/mapInput.js"></script>
            @endsection
