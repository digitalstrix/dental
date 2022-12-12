@extends('clinic.layouts.master');
@section('title', 'Scheduled Meet | Dashboard');
@section('content');
    {{-- {{dd($details)}} --}}

    <body class="vertical  light  ">
        <div class="wrapper">
            <main role="main" class="main-content">
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <a href="{{ route('clinic_dashboard') }}">
                            <button type="button" class="btn btn-primary">View Dashboard</button>
                        </a>


                        <!-- Users -->
                        @if (!empty($details))

                            <div class="card shadow eq-card">
                                <div class="card-header">
                                    <strong class="card-title">Scheduled Meetings</strong>
                                    <a class="float-right small text-muted" href="#!"></a>
                                </div>
                                <div class="card-body">
                                    <table class="table datatables table-hover table-borderless table-striped mt-n3 mb-n1"
                                        id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th>Clinic</th>
                                                <th>Meet Id</th>
                                                <th>Reason</th>
                                                <th>User Name</th>
                                                <th>Your Slot Id</th>

                                                <th>Clinic Time</th>
                                                <th>Clinic Con.</th>
                                                <th>Doctor Con.</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($details as $value)
                                                <tr>
                                                    <td>{{ $value['clinic'] }}</td>
                                                    <td>{{ $value['meet_id'] }}</td>
                                                    <th scope="col">{{ $value['reason'] }}</th>
                                                    <td>{{ $value['username'] }}</td>
                                                    <td>{{ $value['slot_id'] }}</td>
                                                    <td>{{ $value['clinic_time'] }}</td>
                                                    @php
                                                        if ($value['_clinic'] == 1) {
                                                            echo "<td style='color:green'>Meeting Confirmed</td>";
                                                        } else {
                                                            echo "<td style='color:red'>Awaiting</td>";
                                                        }
                                                    @endphp
                                                    @php
                                                        if ($value['_provider'] == 1) {
                                                            echo "<td style='color:green'>Confirmed</td>";
                                                        } else {
                                                            echo "<td style='color:red'>Awaiting</td>";
                                                        }
                                                    @endphp
                                                       @php
                                                       if ($value['is_assistance'] == 1) {
                                                           echo "<td style='color:green'>Confirmed</td>";
                                                       } else {
                                                           echo "<td style='color:red'>Awaiting</td>";
                                                       }
                                                   @endphp
                                                    <td>
                                                        <button class="btn btn-sm dropdown-toggle more-horizontal"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <span class="text-muted sr-only">Action</span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <?php
                                                        if($value['is_completed']==1){
                                                            ?>
                                                            <a class="dropdown-item" href="#">Meeting Completed</a>
                                                            <?php
                                                                }else{
                                                            ?>
                                                            <?php
                                                                if($value['_clinic']==0){
                                                            ?>
                                                            <a class="dropdown-item"
                                                                href="{{ route('clinic_myMeetingConfirmation', $value['meet_id']) }}}">Confirm
                                                                Meet</a>
                                                            <?php
                                                                }
                                                            ?>
                                                            <?php } ?>
                                                            <?php
                                                            if($value['is_assistance']==1){
                                                                ?>
                                                                <a class="dropdown-item" href="#">Already Have Assistance</a>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                <?php
                                                                    if($value['is_assistance']==0){
                                                                ?>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('clinic_haveAssistance', $value['meet_id']) }}}">Have Assistance</a>
                                                                <?php
                                                                    }
                                                                ?>
                                                                <?php } ?>                                                     
                                                                <a class="dropdown-item" href="{{ route('clinic_needAssistance', $value['meet_id']) }}}">Need Assistance</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> <!-- .card-body -->
                            </div> <!-- .card -->
                            <!-- / .col-md-8 -->
                            <!-- Recent Activity -->
                            <!-- / .col-md-3 -->
                    </div> <!-- end section -->
                </div>
                @endif
            @endsection
