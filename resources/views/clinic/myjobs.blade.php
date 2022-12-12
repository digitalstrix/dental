@extends('clinic.layouts.master');
@section('title','Applied Jobs | Dashboard');
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
                <!-- Users -->
                @if(!empty($details))
                <div class="col-md-12">
                    <div class="card shadow eq-card">
                        <div class="card-header">
                            <strong class="card-title">Applied Jobs</strong>
                            <a class="float-right small text-muted" href="#!"></a>
                        </div>
                        <div class="card-body">
                            <table class="table datatables table-hover table-borderless table-striped mt-n3 mb-n1"
                                id="dataTable-1">
                                <thead>
                                    <tr>
                                        <th>Job Id</th>
                                        <th>Meeting</th>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        {{-- <th>Time</th> --}}
                                        <th>Dr. Name</th>
                                        <th>Job Act.</th>
                                        <th>Cand. Sel.</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($details as $value)
                                    <tr>
                                        <td>{{$value['job_id']}}</td>
                                        <td>{{$value['reason']}}</td>
                                        <td>{{$value['email']}}</td>
                                        <td>{{$value['name']}}</td>
                                        <td>{{$value['mobile']}}</td>
                                        {{-- <td>{{$value['time']}}</td> --}}
                                        {{-- <td>{{$value['d_name']}}</td> --}}
                                        <td>{{$value['d_name']}}</td>
                                        @if ($value['is_ended']==0)
                                            <td style="color: green;">Live</td>
                                        @endif
                                        @if ($value['is_ended']==1)
                                        <td style="color: red;">Stop</td>
                                        @endif
                                        @if ($value['is_selected']==0)
                                            <td style="color: red;">Pending</td>
                                        @endif
                                        @if ($value['is_selected']==1)
                                        <td style="color: green;">Selected</td>
                                        @endif
                                        <td>
                                            <button class="btn btn-sm dropdown-toggle more-horizontal"
                                                type="button" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                        @if ($value['is_ended']==0)
                                        <a class="dropdown-item" href="{{route('endjob',[$value['job_id']])}}">End Job</a>
                                        @endif
                                        @if ($value['is_ended']==1)
                                        <a class="dropdown-item" href="{{route('endjob',[$value['job_id']])}}">Make Job Live</a>
                                        @endif
                                        @if ($value['is_selected']==0)
                                        <a class="dropdown-item" href="{{route('hirecandidate',[$value['applied_id']])}}">Hire Candidate</a>
                                        @endif
                                        @if ($value['is_selected']==1)
                                        <a class="dropdown-item" href="{{route('hirecandidate',[$value['applied_id']])}}">Unhire Candidate</a>
                                        @endif
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