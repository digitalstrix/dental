@extends('layouts.master');
@section('title','All Users');
@section('content');
<main role="main" class="main-content">
    <div class="container-fluid">
        <!-- <div class="row justify-content-center"> -->
        <!-- / .row -->
        <div class="row">
            <!-- Users -->
            <div class="col-md-12">
                <div class="card shadow eq-card">
                    <div class="card-header">
                        <strong class="card-title">All Users </strong>
                        <a class="float-right small text-muted" href="#!"></a>
                    </div>
                    <div class="card-body">
                        <table class="table datatables table-hover table-borderless table-striped mt-n3 mb-n1"
                            id="dataTable-1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($data as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <th scope="col">{{$user->name}}</th>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <a href="edituser.php?id={{$user->id}}">Edit User</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <div class="row">
                                {{$data->links()}}
                            </div>
                        </table>
                    </div> <!-- .card-body -->
                </div> <!-- .card -->
            </div> <!-- / .col-md-8 -->
            <!-- Recent Activity -->
            <!-- / .col-md-3 -->
        </div> <!-- end section -->
    </div>
</div> <!-- .row -->
</div> <!-- .container-fluid -->
@endsection