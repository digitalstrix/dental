@extends('clinic.layouts.master');
@section('title','Add Service | Dashboard');
@section('content');
{{-- {{dd($details)}} --}}
<body class="vertical  light  ">
    <div class="wrapper">
        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <a href="{{route('clinic_dashboard')}}">
                        <button type="button" class="btn btn-primary">View Dashboard</button>
                    </a>
                    <div class="card-header">
                        <strong class="card-title">Create Slots For Booking</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" action="{{route('addServiceSave')}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <input hidden required type="text" id="simpleinput" class="form-control"
                                            value="{{session('userid')}}" name="userid">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Add Service</label>
                                        <input  type="text" id="simpleinput" class="form-control"
                                             name="service">
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <input type="submit" id="example-palaceholder" class="btn btn-primary"
                                            value="Save">
                                    </div>
                            </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
                    <div class="row">
                        @if(!empty($details))
                        <div class="col-md-12">
                            <div class="card shadow eq-card">
                                <div class="card-header">
                                    <strong class="card-title">Service Listed </strong>
                                    <a class="float-right small text-muted" href="#!"></a>
                                </div>
                                <div class="card-body">
                                    <table class="table datatables table-hover table-borderless table-striped mt-n3 mb-n1"
                                        id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Service Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach ($details as $value)
                                            <tr>
                                                <td>{{$value['id']}}</td>
                                                <th scope="col">{{$value['service']}}</th>
                                                <td><a target="_blank" href="{{$value['id']}}">View</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> <!-- .card-body -->
                            </div> <!-- end section -->
                         @endif
                </div>
            </div> 
               
@endsection