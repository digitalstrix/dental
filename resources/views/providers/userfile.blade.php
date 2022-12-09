@extends('providers.layouts.master');
@section('title','Providers File | Dashboard');
@section('content');
{{-- {{dd($details)}} --}}
<body class="vertical  light  ">
    <div class="wrapper">
        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <a href="{{route('providers_dashboard')}}">
                        <button type="button" class="btn btn-primary">View Dashboard</button>
                    </a>
                    <div class="row">
                        @if(!empty($details))
                        <div class="col-md-12">
                            <div class="card shadow eq-card">
                                <div class="card-header">
                                    <strong class="card-title">Recieved Files </strong>
                                    <a class="float-right small text-muted" href="#!"></a>
                                </div>
                                <div class="card-body">
                                    <table class="table datatables table-hover table-borderless table-striped mt-n3 mb-n1"
                                        id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th>Patient Name</th>
                                                <th>File Name</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach ($details as $value)
                                            <tr>
                                                <td>{{$value['provider_name']}}</td>
                                                <th scope="col">{{$value['file_name']}}</th>
                                                <td><a target="_blank" href="{{$value['file_url']}}">View</a></td>
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