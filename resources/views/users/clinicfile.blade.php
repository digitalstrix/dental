@extends('users.layouts.master');
@section('title','Providers File | Dashboard');
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
                    <div class="card-header">
                        <strong class="card-title">Upload File's For Providers</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" action="{{route('user_clinicFileStore')}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <input hidden required type="text" id="simpleinput" class="form-control"
                                            value="{{session('userid')}}" name="userid">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Select Provider To Share File</label>
                                        <select  type="text" id="simpleinput" class="form-control"
                                             name="provider">

                                             @foreach ($providers as $value)
                                             {{-- print_r($value); --}}
                                             <option value="{{$value['id']}}">{{$value['name']}}</option>
                                         @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Name Of File</label>
                                        <input placeholder="File Name" type="text" id="simpleinput" class="form-control"
                                            value="" name="name">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Select File To Share</label>
                                        <input  type="file" id="simpleinput" class="form-control" 
                                            value="" name="file">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="submit" id="example-palaceholder" class="btn btn-primary"
                                            value="Upload">
                                    </div>
                            </div> <!-- /.col -->
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
                            <strong class="card-title">Sent Files </strong>
                            <a class="float-right small text-muted" href="#!"></a>
                        </div>
                        <div class="card-body">
                            <table class="table datatables table-hover table-borderless table-striped mt-n3 mb-n1"
                                id="dataTable-1">
                                <thead>
                                    <tr>
                                        <th>Provider Name</th>
                                        <th>File Name</th>
                                        <th>View</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($details as $value)
                                    <tr>
                                        <td>{{$value['provider_name']}}</td>
                                        <th scope="col">{{$value['file_name']}}</th>
                                        @php
                    $link = 'storage/'.trim($value['file_url'],"public");
                @endphp
                                                <td><a target="_blank" href="{{url($link)}}">View</a></td>
                                        <td>
                                            <a href="{{route('user_clinicFileDelete',$value['file_id'])}}">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- .card-body -->
                    </div> <!-- .card -->
                </div> <!-- / .col-md-8 -->
            </div> <!-- end section -->
        </div>
        @endif
@endsection