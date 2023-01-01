@extends('providers.layouts.master');
@section('title','Dentavibe Chat | Dashboard');
@section('css')
<link rel="stylesheet" href="{{ asset('css/chat.css') }}">
@endsection
@section('content')
{{-- @php dd(request()->route()->parameters['id'])
@endphp --}}

<body>
    <section class="msger">
        <header class="msger-header">
            <div class="msger-header-title">
                <i class="fas fa-comment-alt"></i>Dentavibe Chat 
            </div>
            <div class="msger-header-options">
                <span><i class="fas fa-cog"></i></span>
            </div>
        </header>

        <main class="msger-chat">
            <div class="msg left-msg">
                <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)">
                </div>

                <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">Dentavibe Admin</div>
                        
                    </div>

                    <div class="msg-text">
                        Hi {{ session('name') }} , welcome to Dentavibe! Go ahead and send messages to your scheduled Meet User and Clinic. 😄
                    </div>
                </div>
            </div>
<?php
    if(!empty($messages)){
        foreach ($messages as $key => $value) {
   ?>
   <?php
   if($value['user_id']==Session('userid')&&$value['type']=='provider'){ 
   ?>
            <div class="msg right-msg">
                <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)">
                </div>
                <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">{{$value['name']}}</div>
                        <div class="msg-info-time">{{$value['time']}}</div>
                    </div>
                    <div class="msg-text">
                        {{$value['message']}}
                    </div>
                </div>
            </div>
            <?php
           }else{
            ?>
           <div class="msg left-msg">
            <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)">
            </div>
            <div class="msg-bubble">
                <div class="msg-info">
                    <div class="msg-info-name">{{$value['name']}} - {{$value['type']}}</div>
                    <div class="msg-info-time">{{$value['time']}}</div>
                </div>
                <div class="msg-text">
                    {{$value['message']}}
                </div>
            </div>
        </div>
            <?php } ?>
            <?php
        }
    }
?>
        </main>

        <form class="msger-inputarea" method="POST" action="{{route('provider_sendMessage')}}">
            @csrf
            <input hidden name="meeting_id" value="{{request()->route()->parameters['id']}}">
            <input type="text" name="message" class="msger-input" placeholder="Enter your message...">
            <button type="submit" class="msger-send-btn">Send</button>
        </form>
    </section>
    @endsection
    <script src="{{ asset('js/chat.js') }}"></script>

