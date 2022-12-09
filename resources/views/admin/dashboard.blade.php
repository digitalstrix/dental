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
                                            <p class="small text-uppercase text-muted mb-0">Total Users
                                            </p>
                                            <span class="h2 mb-0">909</span>
                                            <p class="small mb-0">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-4">
                                            <p class="small text-uppercase text-muted mb-0">Total Shops
                                            </p>
                                            <span class="h2 mb-0">809</span>
                                            <p class="small mb-0">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-4">
                                            <p class="small text-uppercase text-muted mb-0">Total Posted Work
                                            </p>
                                            <span class="h2 mb-0">807</span>
                                            <p class="small mb-0">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-4">
                                            <p class="small text-uppercase text-muted mb-0">Total Posted Jobs
                                            </p>
                                            <span class="h2 mb-0">605</span>
                                            <p class="small mb-0">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-4">
                                            <p class="small text-uppercase text-muted mb-0">Total Applied Jobs
                                            </p>
                                            <span class="h2 mb-0">405</span>
                                            <p class="small mb-0">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-4">
                                            <p class="small text-uppercase text-muted mb-0">Total Active Offers
                                            </p>
                                            <span class="h2 mb-0">606</span>
                                            <p class="small mb-0">

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .col-md-8 -->
                    </div> <!-- end section -->
                </div> <!-- .card-body -->
            </div> <!-- .card -->
            <!-- / .row -->
            <div class="row">
                <!-- Recent orders -->
            </div> <!-- end section -->
        </div>
    </div> <!-- .row -->
</div> <!-- .container-fluid -->   
@endsection