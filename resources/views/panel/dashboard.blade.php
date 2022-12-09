<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>dashboard</title>
</head>

<body>

<h1>User</h1>
   <div><a href="{{ route('user_login') }}">User's login</a></div> 
    <div><a href="{{ route('user_register') }}">User's register</a></div>

    <h1>Provider</h1>
    <div><a href="{{ route('provider_login') }}">Provider's login</a></div>
    <div><a href="{{ route('provider_register') }}">Provider's register</a></div>

    <h1>Clinic</h1>
    <div><a href="{{ route('clinic_login') }}">Clinic's Login</a></div>
    <div><a href="{{ route('clinic_register') }}">Clinic's register</a></div>

    <h1>Admin</h1>
    <div><a href="{{ route('admin_login') }}">Admin's Login</a></div>
    <div><a href="{{ route('admin_register') }}">Admin's register</a></div>

</body>

</html>
