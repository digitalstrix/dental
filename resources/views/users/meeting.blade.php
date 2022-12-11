@extends('users.layouts.master');
@section('title','Schedule Meet | Dashboard');
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
                        <strong class="card-title">Schedule Meet</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" action="{{route('schedulemeet_save')}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <input hidden required type="text" id="simpleinput" class="form-control"
                                            value="{{session('userid')}}" name="userid">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Select Doctor</label>
                                        <select required  type="text" id="provider-id" class="form-control"
                                             name="provider">
                                             <option value="">Select Doctor</option>
                                             @foreach ($details as $value)
                                             <option value="{{$value['provider_id']}}">{{$value['provider_name']}} - {{round($value['distance'],2)}} Kms</option>
                                         @endforeach
                                        </select>
                                        <span class="text-danger">
                                            @error('provider')
                                                {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Doctors Avaliable Slots</label>
                                        <select required  type="text" id="pslots" class="form-control"
                                             name="providers_slot">
                                        </select>
                                        <span class="text-danger">
                                            @error('providers_slot')
                                                {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Select Clinic</label>
                                        <select required  type="text" id="clinics" class="form-control"
                                             name="clinic">
                                        </select>
                                        <span class="text-danger">
                                            @error('clinic')
                                                {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Clinic Available Slot</label>
                                        <select required type="text" id="cslots" class="form-control"
                                             name="clinic_slot">
                                        </select>
                                        <span class="text-danger">
                                            @error('clinic_slot')
                                                {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Reason For Meeting</label>
                                        <input required placeholder="Reason for visit." type="text" id="simpleinput" class="form-control"
                                            value="" name="reason">
                                            <span class="text-danger">
                                                @error('reason')
                                                    {{$message}}
                                                @enderror
                                            </span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="submit" id="example-palaceholder" class="btn btn-primary"
                                            value="Schedule Meet">
                                    </div>
                            </div> <!-- /.col -->
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="row">
                @if(!empty($details1))
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
                                        <td><a target="_blank" href="{{$value['file_url']}}">View</a></td>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
         $(document).ready(function () {
            $('#provider-id').on('change', function () {
                var idCountry = this.value;
                $("#pslots").html('');
                $.ajax({
                    url: "{{url('api/fetch-pslots')}}",
                    type: "POST",
                    data: {
                        provider: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#pslots').html('<option value="">Select Providers Slot</option>');
                        $.each(result.pslots, function (key, value) {
                            $("#pslots").append('<option value="' + value
                                .id + '">' + value.start + ' To '+ value.end +'</option>');
                        });
                        $('#clinics').html('<option value="">Select Clinic</option>');
                        $.each(result.clinics, function (key, value) {
                            $("#clinics").append('<option value="' + value
                                .id + '">' + value.name +  ' - '+ value.distance +' Kms</option>');
                        });
                        
                    }
                });
            });
            $('#clinics').on('change', function () {
                var idState = this.value;
                $("#cslots").html('');
                $.ajax({
                    url: "{{url('api/fetch-cslots')}}",
                    type: "POST",
                    data: {
                        clinics: idState,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#cslots').html('<option value="">Select Clinic SLot</option>');
                        $.each(res.cslots, function (key, value) {
                            $("#cslots").append('<option value="' + value
                                .id + '">' + value.start + ' To '+ value.end +'</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection