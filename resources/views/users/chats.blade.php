@extends('users.layouts.master');
@section('title','Meeting Chat | Dashboard');
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
                            <strong class="card-title">Open Meeting Chats</strong>
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
                                        <th>Chat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($details as $value)
                                    <tr>
                                        <td>{{$value['meet_id']}}</td>
                                        <th scope="col">{{$value['reason']}}</th>
                                        <td>{{$value['provider']}}</td>
                                        <td>{{$value['clinic']}}</td>
                                        <td> <a href="{{route('userschat',$value['meet_id'])}}">
                                            <button type="button" class="btn btn-primary">Open Chat</button>
                                        </a></td>
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