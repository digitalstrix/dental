@extends('layouts.master');
@section('title','Profile');
@section('content');

<body class="vertical  light  ">
    <div class="wrapper">
        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <a href="{{route('users')}}">
                        <button type="button" class="btn btn-primary">View Users</button>
                    </a>
                    <div class="card-header">
                        <strong class="card-title">Edit User</strong>
                    </div>
                    

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" action="controllers/edituserhandler.php" method="POST"
                                    enctype="multipart/form-data">
                                    <div class="form-group mb-3">
                                        <input hidden required type="text" id="simpleinput" class="form-control"
                                            value="<?php echo $user['id'] ?>" name="id">
                                        <input hidden required type="text" id="simpleinput" class="form-control"
                                            value="<?php echo $user['email'] ?>" name="email">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Name</label>
                                        <input required type="text" id="simpleinput" class="form-control"
                                            value="<?php echo $user['name'] ?>" name="name">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Mobile</label>
                                        <input required type="text" id="simpleinput" class="form-control"
                                            value="<?php echo $user['mobile'] ?>" name="mobile">
                                    </div>


                                    <div class="form-group mb-3">
                                        <label for="custom-select">User Type</label>
                                        <select required name="user_type" class="custom-select" id="custom-select">
                                            <option selected value="<?php echo $user['userType'] ?>">
                                                <?php echo $user['userType'] ?>
                                            </option>
                                            <option value="admin">Admin
                                            </option>
                                            <option value="shop">Shop Admin
                                            </option>
                                            <option value="user">User
                                            </option>
                                        </select>
                                    </div>



                                    <div class="form-group mb-3">

                                        <input type="submit" id="example-palaceholder" class="btn btn-primary"
                                            value="Submit">
                                    </div>
                            </div> <!-- /.col -->
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- .container-fluid -->
@endsection