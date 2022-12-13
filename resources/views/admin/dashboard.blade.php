@extends('admin.layouts.master');
@section('title','Admin Dashboard');
@section('content');
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    <div class="col">
                        <h2 class="h5 page-title">Welcome {{session('name')}} !</h2>
                    </div>
                    <div class="col-auto">
                        <form class="form-inline"enctype="multipart/form-data">
                            <div class="form-group d-none d-lg-inline">
                                <label for="reportrange" class="sr-only">Date Ranges</label>
                                <div id="reportrange" class="px-2 py-2 text-muted">
                                    <span class="small"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-sm"><span
                                        class="fe fe-refresh-ccw fe-16 text-muted"></span></button>
                                <button type="button" class="btn btn-sm mr-2"><span
                                        class="fe fe-filter fe-16 text-muted"></span></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card shadow my-4">
                    <div class="card-body">
                        <div class="row align-items-center my-12">
                            <div class="col-md-12">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="p-4">
                                            <p class="small text-uppercase text-muted mb-0">Total Upcoming Appointments
                                            </p>
                                            <span class="h2 mb-0">{{$umeetings}}</span>
                                            <p class="small mb-0">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-4">
                                            <p class="small text-uppercase text-muted mb-0">Total Completed Meetings
                                            </p>
                                            <span class="h2 mb-0">{{$cmeetings}}</span>
                                            <p class="small mb-0">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-4">
                                            <p class="small text-uppercase text-muted mb-0">Total Provider Reviews
                                            </p>
                                            <span class="h2 mb-0">{{$ptreviews}}</span>
                                            <p class="small mb-0">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-4">
                                            <p class="small text-uppercase text-muted mb-0">Total Clinic Review
                                            </p>
                                            <span class="h2 mb-0">{{$ctreviews}}</span>
                                            <p class="small mb-0">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-4">
                                            <p class="small text-uppercase text-muted mb-0">Query Recieved 
                                            </p>
                                            <span class="h2 mb-0">{{$qrecieve}}</span>
                                            <p class="small mb-0">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-4">
                                            <p class="small text-uppercase text-muted mb-0">Jobs Posted 
                                            </p>
                                            <span class="h2 mb-0">{{$jobs}}</span>
                                            <p class="small mb-0">
                                            </p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- .col-md-8 -->
                    </div> <!-- end section -->
                </div> <!-- end section -->
        </div>
    </div> <!-- .row -->
</div> <!-- .container-fluid -->   
@endsection