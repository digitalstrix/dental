@extends('clinic.layouts.master');
@section('title','Clinic Slots | Dashboard');
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
                                <form role="form" action="{{route('clinic_slots_save')}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <input hidden required type="text" id="simpleinput" class="form-control"
                                            value="{{session('userid')}}" name="userid">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Start Time Of Slot</label>
                                        <input  type="datetime-local" id="simpleinput" class="form-control"
                                             name="start">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">End Time Of Slot</label>
                                        <input  type="datetime-local" id="simpleinput" class="form-control"
                                             name="end">
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
                <!-- Users -->
                @if(!empty($details))
                <div class="col-md-12">
                    <div class="card shadow eq-card">
                        <div class="card-header">
                            <strong class="card-title">Sent Files </strong>
                            <a class="float-right small text-muted" href="#!"></a>
                        </div>
                        <div class="card-body">
                            <table class="table datatables table-hover table-borderless table-striped mt-n3 mb-n1"
                                id="dataTable-1">
                                <thead>
                                    <tr>
                                        <th>Sno.</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Duration</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($details as $value)
                                    <tr>
                                        @php
                                            $datetime_1 = $value['start']; 
                                            $datetime_2 = $value['end'];
                                            $from_time = strtotime($datetime_1); 
                                            $to_time = strtotime($datetime_2); 
                                            $diff_minutes = round(abs($from_time - $to_time) / 60,2). " minutes";
                                        @endphp
                                        <td>{{$value['id']}}</td>
                                        <th scope="col">{{$value['start']}}</th>
                                        <th scope="col">{{$value['end']}}</th>
                                        <th scope="col">{{$diff_minutes}}</th>
                                        <td>
                                            <a href="{{route('clinic_slots_delete',$value['id'])}}">Delete</a>
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