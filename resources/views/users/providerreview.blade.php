@extends('users.layouts.master');
@section('title','Providers Review | Dashboard');
@section('content');
{{-- {{dd($details)}} --}}
<body class="vertical  light  ">
    <div class="wrapper">
        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <a href="{{route('user_dashboard')}}">
                        <button type="button" class="btn btn-primary">View Dashboard</button>
                    </a>
                    <div class="card-header">
                        <strong class="card-title">Review For Doctor</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" action="{{route('providerReviewSave')}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <input hidden required type="text" id="simpleinput" class="form-control"
                                            value="{{session('userid')}}" name="userid">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input hidden required type="text" id="simpleinput" class="form-control"
                                            value="{{$details}}" name="providerid">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input hidden required type="text" id="simpleinput" class="form-control"
                                            value="{{$details1}}" name="meetingid">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Share Your Review</label>
                                        <input  type="text" id="simpleinput" class="form-control"
                                             name="review">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Rate Your Experience</label>
                                        <input  type="number" min="0" max="5" id="simpleinput" class="form-control" 
                                            value="" name="rating">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="submit" id="example-palaceholder" class="btn btn-primary"
                                            value="Review">
                                    </div>
                            </div> <!-- /.col -->
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
@endsection