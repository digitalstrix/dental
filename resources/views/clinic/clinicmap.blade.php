@extends('clinic.layouts.master');
@section('title','Clinic Visit | Dashboard');
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
                        <strong class="card-title">Add Clinic You Wants To Visit.</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" action="{{route('clinicMapSave')}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <input hidden required type="text" id="simpleinput" class="form-control"
                                            value="{{session('userid')}}" name="userid">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Select Clinic</label>
                                        <select  type="datetime-local" id="simpleinput" class="form-control"
                                             name="clinic">
                                             @foreach ($clinic as $clinic)
                                                 <option value="{{$clinic->id}}">{{$clinic->name}} - {{round($clinic->distance,2)}} Km's</option>
                                             @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="submit" id="example-palaceholder" class="btn btn-primary"
                                            value="Save">
                                    </div>
                            </div> <!-- /.col -->
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="row">
                <!-- Users -->
                @if(!empty($details))
                <div class="col-md-12">
                    <div class="card shadow eq-card">
                        <div class="card-header">
                            <strong class="card-title">I want to visit these locations.</strong>
                            <a class="float-right small text-muted" href="#!"></a>
                        </div>
                        <div class="card-body">
                            <table class="table datatables table-hover table-borderless table-striped mt-n3 mb-n1"
                                id="dataTable-1">
                                <thead>
                                    <tr>
                                        <th>Sno.</th>
                                        <th>Clinic Name</th>
                                        <th>Distance</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($details as $value)
                                    <tr>
                                        <td>{{$value['id']}}</td>
                                        <th scope="col">{{$value['name']}}</th>
                                        <th scope="col">{{round($value['distance'],2)}} Kms</th>
                                        <td>
                                            <a href="{{route('clinic_visit_delete',$value['id'])}}">Delete</a>
                                            <a href="{{route('clinic_slots_delete',$value['id'])}}">Navigate</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- .card-body -->
                    </div> <!-- .card -->
                </div> <!-- / .col-md-8 -->
                <!-- Recent Activity -->
                <!-- / .col-md-3 -->
            </div> <!-- end section -->
        </div>
        @endif
@endsection