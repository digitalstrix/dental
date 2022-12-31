@extends('providers.layouts.master');
@section('title','Meeting Chat | Dashboard');
@section('content');
{{-- {{dd($doctors)}} --}}
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
                                        <th>Patient</th>
                                        <th>Clinic</th>
                                        <th>Chat</th>
                                        <th>Assign Dr.</th>
                                        <th>Add</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($details as $value)
                                    <tr>
                                        <td>{{$value['meet_id']}}</td>
                                        <th scope="col">{{$value['reason']}}</th>
                                        <td>{{$value['user']}}</td>
                                        <td>{{$value['clinic']}}</td>
                                        <td> <a href="{{route('provider_userschat',$value['meet_id'])}}">
                                            <button type="button" class="btn btn-primary">Open Chat</button>
                                        </a></td>
                                        <form action="{{route('addChatProvider')}}" method="POST">
                                            @csrf
                                            <input hidden name="meeting_id" value="{{$value['meet_id']}}" type="text">
                                        <td>
                                            <select name="provider_id" id="simpleinput" class="form-control" required>
                                                <option value="">Add Dr. to Chat</option>
                                                <?php 
                                                    foreach($doctors as $doctor) {
                                                ?>
                                                <option value="{{$doctor['id']}}">{{$doctor['name']}} </option>
                                            <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td> 
                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </td>
                                        <td>
                                        </td>
                                        </form>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- .card-body -->
                    </div> <!-- .card -->
                </div> <!-- / .col-md-8 -->
                <!-- Recent Activity -->
                <!-- / .col-md-3 -->
            </div> 
            @endif<!-- end section -->
            <div class="row">
                <!-- Users -->
                @if(!empty($assigns))
                <div class="col-md-12">
                    <div class="card shadow eq-card">
                        <div class="card-header">
                            <strong class="card-title">Assigned Meeting Chats</strong>
                            <a class="float-right small text-muted" href="#!"></a>
                        </div>
                        <div class="card-body">
                            <table class="table datatables table-hover table-borderless table-striped mt-n3 mb-n1"
                                id="dataTable-1">
                                <thead>
                                    <tr>
                                        <th>Meet Id</th>
                                        <th>Reason</th>
                                        <th>Assigned By Dr.</th>
                                        <th>Chat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($assigns as $value)
                                    <tr>
                                        <td>{{$value['meeting_id']}}</td>
                                        <th scope="col">{{$value['reason']}}</th>
                                        <td>{{$value['assigned_by']}}</td>
                                        <td> <a href="{{route('provider_userschat',$value['meeting_id'])}}">
                                            <button type="button" class="btn btn-primary">Open Chat</button>
                                        </a></td>
                                        </form>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- .card-body -->
                    </div> <!-- .card -->
                </div> <!-- / .col-md-8 -->
                <!-- Recent Activity -->
                <!-- / .col-md-3 -->
            </div> 
            @endif<!-- end section -->
        </div>
        
@endsection