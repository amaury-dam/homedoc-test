@extends('patient/coreMenu')

@section('content')
    <div class="container">
        <div class="page-surroundings">
            <div class="conversations-header">
                <div style="float: left; width: 70%; height: 100%; display: flex; align-items: center; justify-content: left;">
                    <h2 class="private-messages">Conversations privées</h2>
                </div>
                <div style="float: left; width: 30%; height: 100%; display: flex; align-items: center; justify-content: right;">
                    <a class="btn new-conversation" style="border-radius: 50px; color: white; background-color: #4c934c;" onclick="location.href='/patient/newConversation';">Nouvelle conversation</a>
                </div>

            </div>
            <div id="conversations-list" style="padding: 0;">
                    @foreach ($conversationsList as $conversation)
                        @if ($conversation['member'] == "Home'Doc")
                            <div class="conversations-item" onclick="location.href='/patient/messaging/{{ $conversation['uid'] }}/homedoc';" >
                                <div class="conversations-item-header-logo">
                                    <img class="conversations-item-header-img" alt="logo" src="/ressources/logo-petit.png">
                                </div>
                                <div class="conversations-item-header-text">
                                    <div><strong>{{$conversation['member']}}</strong></div>
                                    @if(isset($conversation['text']))
                                        <div style="font-size: 14px;">{{$conversation['text']}}</div>
                                    @endif
                                </div>
                                <div class="conversations-item-header-date">
                                    @if(isset($conversation['date']))
                                        {{ DateTime::createFromFormat('Y-m-d H:i:s', $conversation['date'])->format('H:i') }}
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="conversations-item" onclick="location.href='/patient/messaging/{{ $conversation['uid'] }}';" >
                                <div class="conversations-item-header-logo">
                                    <img style="display: flex; align-items: center; justify-content: center;" alt="logo" height="60" src="/ressources/logo-medecin2.jpg">
                                </div>
                                <div class="conversations-item-header-text">
                                    <div><strong>{{$conversation['member']}}</strong></div>
                                    @if(isset($conversation['text']))
                                        <div style="font-size: 14px;">{{$conversation['text']}}</div>
                                    @endif
                                </div>
                                <div class="conversations-item-header-date">
                                    @if(isset($conversation['date']))
                                        {{ DateTime::createFromFormat('Y-m-d H:i:s', $conversation['date'])->format('H:i') }}
                                    @endif
                                </div>
                            </div>
                        @endif



                    @endforeach

            </div>
        </div>
    </div>
    <script>

        function formatDate(date)
        {
            if (date != null) {
                date = new Date(date);
                var minutes = date.getMinutes();
                var hours = date.getHours();


                minutes = minutes + "";

                if (minutes.length == 1)
                {
                    minutes = "0" + minutes;
                }

                hours = hours + "";

                if (hours.length == 1)
                {
                    hours = "0" + hours;
                }

                return hours + ':' + minutes;
            } else {
                return "";
            }
        }

        $(document).ready(function() {

            setInterval(function(){
                //code goes here that will be run every 5 seconds.
                $.ajax({
                    type: "POST",
                    url: "/patient/listConversations",
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        $("#conversations-list").html('');
                        data.forEach(function (element) {
                            if (element.member === "Home'Doc") {
                                let url = "/patient/messaging/" + element.uid + "/homedoc";
                                $("#conversations-list").append(
                                    "<a class='conversations-item' href='" + url +"'>" +
                                    "<div class='conversations-item-header-logo'>" +
                                    "<img class='conversations-item-header-img' alt='logo' src='/ressources/logo-petit.png'>" +
                                    "</div>" +
                                    "<div class='conversations-item-header-text'>" +
                                    "<div><strong>" + element.member + "</strong></div>" +
                                    "<div style='font-size: 14px;'>" + (element.text ? element.text : "") + "</div>" +
                                    "</div>" +
                                    "<div class='conversations-item-header-date'>" +
                                        formatDate(element.date) +
                                    "</div>" +
                                    "</a>");

                            } else {
                                let url = "/patient/messaging/" + element.uid;
                                $("#conversations-list").append(
                                    "<a class='conversations-item' href='" + url +"'>" +
                                    "<div class='conversations-item-header-logo'>" +
                                    "<img class='conversations-item-header-img' alt='logo' src='/ressources/logo-medecin2.jpg'>" +
                                    "</div>" +
                                    "<div class='conversations-item-header-text'>" +
                                    "<div><strong>" + element.member + "</strong></div>" +
                                    "<div style='font-size: 14px;'>" + (element.text ? element.text : "") + "</div>" +
                                    "</div>" +
                                    "<div class='conversations-item-header-date'>" +
                                        formatDate(element.date) +
                                    "</div>" +
                                    "</a>");
                            }
                        })
                    },
                    error: function () {

                    }
                });
            }, 2000);
        });
    </script>

@endsection