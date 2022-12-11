@extends('users.layouts.master');
@section('title','Schedule   Meet | Dashboard');
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
                </div>
            </div> 
            <div class="row">
                <!-- Users -->
                @if(!empty($details))
                <div class="col-md-12">
                    <div class="card shadow eq-card">
                        <div class="card-header">
                            <strong class="card-title">Schedule Meetings</strong>
                            <a class="float-right small text-muted" href="#!"></a>
                        </div>
                        <div class="card-body">
                            <table class="table datatables table-hover table-borderless table-striped mt-n3 mb-n1"
                                id="dataTable-1">
                                <thead>
                                    <tr>
                                        <th>Meet Id</th>
                                        <th>Reason</th>
                                        <th>Doctor</th>
                                        <th>Clinic</th>
                                        <th>Doctor Con.</th>
                                        <th>Clinic Con.</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($details as $value)
                                    <tr>
                                        <td>{{$value['meet_id']}}</td>
                                        <th scope="col">{{$value['reason']}}</th>
                                        <td>{{$value['provider']}}</td>
                                        <td>{{$value['clinic']}}</td>
                                        @php
                                            if($value['_clinic']==1){
                                                echo "<td style='color:green'>Confirmed</td>";
                                            }else{
                                                echo "<td style='color:red'>Awaiting</td>";
                                            }
                                        @endphp
                                        @php
                                            if($value['_provider']==1){
                                                echo "<td style='color:green'>Confirmed</td>";
                                            }else{
                                                echo "<td style='color:red'>Awaiting</td>";
                                            }
                                        @endphp
                            
                                        <td>
                                            <button class="btn btn-sm dropdown-toggle more-horizontal" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="http://www.google.com/maps/place/{{$value['clinic_latitude']}},{{$value['clinic_longitude']}}">Navigate</a>
                                                <?php
                                                    if($value['meeting_link']!=null){
                                                ?>
                                                <a class="dropdown-item" href="{{$value['meeting_link']}}">Join Meet</a>
                                                <?php
                                                    }
                                                ?>
                                            </div>
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