@extends('providers.layouts.master');
@section('title','eMeet Box | Dashboard');
@section('content');
{{-- {{dd($details)}} --}}
<body class="vertical  light  ">
    <div class="wrapper">
        <main role="main" class="main-content">
            <div class="container-fluid">
                
                    <a href="{{route('provider_dashboard')}}">
                        <button type="button" class="btn btn-primary">View Dashboard</button>
                    </a>
                    <div class="card-header">
                        <strong class="card-title">Dentavibe eMeet Box</strong>
                    </div>
                        <iframe allow="camera; microphone; fullscreen; display-capture; autoplay" src="https://meet.jit.si/{{$meet}}" style="height: 100%; width: 100%; border: 0px;"></iframe>
            </div> 
@endsection
