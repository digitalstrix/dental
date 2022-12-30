<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Chat</title>
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
</head>

<body>
    <section class="msger">
        <header class="msger-header">
            <div class="msger-header-title">
                <i class="fas fa-comment-alt"></i> SimpleChat
            </div>
            <div class="msger-header-options">
                <span><i class="fas fa-cog"></i></span>
            </div>
        </header>

        <main class="msger-chat">
            <div class="msg left-msg">
                <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)">
                </div>
                @foreach ($chat_details as $chat_detail)
                    <div class="msg-bubble">
                        <div class="msg-info">
                            <div class="msg-info-name">{{ session('name') }}</div>
                            {{-- <div class="msg-info-time">{{$chat_details->meeting_at}}</div> --}}
                        </div>

                        {{-- {{dd($chat_detail);}} --}}
                        {{-- @if ($chat_detail->type = 'user' && ($chat_detail->user_id = session('userid'))) --}}
                        <div class="msg-text">
                            @if (isset($chat_detail->message))
                                {{ $chat_detail->message }}😄
                            @endif
                          
                        </div>
                        {{-- @endif --}}
                    </div>
                    
            
                @endforeach
            </div>
            {{-- <div class="msg-text">
                    Hi, welcome to SimpleChat! Go ahead and send me a message. 😄
                </div> --}}
            

            <div class="msg right-msg">
                <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)">
                </div>

                <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">Sajad</div>
                        <div class="msg-info-time">12:46</div>
                    </div>

                    <div class="msg-text">
                        You can change your name in JS section!
                    </div>
                </div>
            </div>
        </main>

        <form action="{{ route('userschat') }}" id="msger" method="post">
            @csrf
            {{-- {{ dd(session('userid'))}} --}}
            <input type="hidden" name="member_id" value="{{ session('userid') }}">
            <input type="text" name="message" placeholder="Enter your message...">
            <button type="submit" class="msger-send-btn">Send</button>
        </form>
    </section>
    <script src="{{ asset('js/chat.js') }}"></script>
    <script>
        //   $(document).on("click", ".open-leaveEditModal", function() {
        //     var id = $(this).data('id');
        //     var employee_id = $(this).data('employee_id');
        //     var user_name = $(this).data('user_name');
        //     var leave_type = $(this).data('leave_type');
        //     var start_date = $(this).data('start_date');
        //     var created_at = $(this).data('created_at');
        //     var end_date = $(this).data('end_date');
        //     var status = $(this).data('status');
        //     var leave_reason = $(this).data('leave_reason');

        //     $(".modal-body #id").val(id);
        //     $(".modal-body #employee_id").val(employee_id);
        //     $(".modal-body #user_name").val(user_name);
        //     $(".modal-body #leave_type").val(leave_type);
        //     $(".modal-body #start_date").val(start_date);
        //     $(".modal-body #end_date").val(end_date);
        //     $(".modal-body #created_at").html(created_at);
        //     $(".modal-body #status").val(status);
        //     $(".modal-body #leave_reason").val(leave_reason);
        // });

        $("#msger").on("submit", function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: "{{ route('userschat') }}",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    document.getElementById("userschat").reset();
                    location.reload();
                    Swal.fire({
                        icon: "success",
                        title: "msg sended",
                        text: response.message,
                    });
                },
                error: function(response) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!"
                    });
                },
            });
        });
    </script>
</body>

</html>
