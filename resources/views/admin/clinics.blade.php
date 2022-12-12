@extends('admin.layouts.master');
@section('title', 'Admin Dashboard');
@section('content');
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row align-items-center mb-2">
                        <div class="col">
                            <h2 class="h5 page-title">Welcome {{ session('name') }} !</h2>
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
                            @if (!empty($details))
                                <div class="col-md-12">
                                    <div class="card shadow eq-card">
                                        <div class="card-header">
                                            <strong class="card-title">Clinics Details </strong>
                                            <a class="float-right small text-muted" href="#!"></a>
                                        </div>
                                        <div class="card-body">
                                            <table
                                                class="table datatables table-hover table-borderless table-striped mt-n3 mb-n1"
                                                id="dataTable-1">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Clinic Name</th>
                                                        <th>Mobile</th>
                                                        <th>Email</th>
                                                        <th>Address</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($details as $value)
                                                        <tr>
                                                            <td>{{ $value['id'] }}</td>
                                                            <th scope="col">{{ $value['name'] }}</th>
                                                            <td>{{ $value['mobile'] }}</td>
                                                            <td>{{ $value['email'] }}</td>
                                                            <td>{{ $value['address'] }}</td>
                                                            <td><a  href="{{url('admin/clinic/delete/'. $value['id'] )}}">Delete</a></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div> <!-- .card-body -->
                                    </div> <!-- end section -->
                            @endif
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
