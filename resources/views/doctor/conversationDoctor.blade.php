@extends('doctor/coreMenu')

@section('content')
    <div class="container">
        <div class="page-surroundings">
            <div style="height: 80px; border-bottom: 1px solid #e6ecf0;">
                <div style="float: left; width: 10%; height: 100%; display: flex; align-items: center; justify-content: center;">
                    <img style="display: flex; align-items: center; justify-content: center;" alt="logo" height="60" src="/ressources/logo-patient.png">
                </div>
                <div style="float: left; width: 80%; height: 100%; display: flex; align-items: center; justify-content: left;">
                    <h3 style="color:#343a40; font-weight: bold; font-size: 22px;">{{$profil['lastname']}} {{ $profil['firstname'] }}</h3>
                </div>
                <div style="float: left;width: 10%; height: 100%; display: flex; align-items: center; justify-content: center;">
                    <a style="border-radius: 50px; color: white;" class="btn btn-danger" id="delete"><i class="far fa-trash-alt"></i></a>
                </div>

            </div>
            <div class="body-chat" id="body-chat">

            </div>
            <div>
                <div class="foot-chat">
                    <input id="input" type="text" class="input-chat" placeholder="Ecrivez un messsage ...">
                </div>
            </div>

        </div>
    </div>
    <div id="myModal" class="modal">
        <span id="closeModal" class="closeModal">&times;</span>
        <img class="modal-content" id="imgModal">
    </div>
    <script>
        var uid = "<?php echo $conversationId ?>";
        var memberId = "<?php echo $memberId ?>";
        console.log(memberId);
        console.log(uid);
        var accessToken = "4f73c79425254a63a38ad7537647b11d";
        var baseUrl = "https://api.api.ai/v1/";

        $( "#delete" ).click(function() {
            $.ajax({
                type: "POST",
                url: "/patient/deleteConversation",
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: JSON.stringify({ uid: uid}),
                success: function(data) {
                    location.href = "/doctor/messaging"
                },
                error: function() {

                }
            });
        });

        $(document).ready(function() {
            setInterval(function(){
                //code goes here that will be run every 5 seconds.
                $.ajax({
                    type: "POST",
                    url: "https://messaging.homedoc.fr/retrieveMessages/",
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    data: JSON.stringify({ uid: uid, member: memberId} ),
                    success: function(data) {
                        if (data.conversation.messages.length > 0) {
                            for (i = 0; i < data.conversation.messages.length; i++) {
                                if (data.conversation.messages[i].type === "image")
                                    setPicture(data.conversation.messages[i].text);
                                else
                                    setResponse(data.conversation.messages[i].text);
                            }
                            $('#body-chat').scrollTop($('#body-chat')[0].scrollHeight);
                        }
                        $.ajax({
                            type: "POST",
                            url: "https://messaging.homedoc.fr/updateMessages/",
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",
                            data: JSON.stringify({ uid: uid, member: memberId} ),
                            success: function(data) {
                            },
                            error: function() {

                            }
                        });
                    },
                    error: function() {

                    }
                });
            }, 2000);

            $.ajax({
                type: "GET",
                url: "https://messaging.homedoc.fr/conversation/" + uid,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(data) {

                        for (i = 0; i < data.conversation.messages.length; i++) {
                            if (data.conversation.messages[i].member === memberId) {
                                if (data.conversation.messages[i].type === "image")
                                    setPictureDemand(data.conversation.messages[i].text);
                                else
                                    setDemand(data.conversation.messages[i].text);
                            }
                            else {
                                if (data.conversation.messages[i].type === "image")
                                    setPicture(data.conversation.messages[i].text);
                                else
                                    setResponse(data.conversation.messages[i].text);
                            }



                        }
                    $('#body-chat').scrollTop($('#body-chat')[0].scrollHeight);

                },
                error: function() {

                }
            });

            $("#input").keypress(function(event) {
                if (event.which == 13) {
                    event.preventDefault();
                    send();
                }
            });
            $("#rec").click(function(event) {
                // switchRecognition();
                send();
            });
        });
        var recognition;

        Number.prototype.padLeft = function(base,chr){
            var  len = (String(base || 10).length - String(this).length)+1;
            return len > 0? new Array(len).join(chr || '0')+this : this;
        };

        function doRequestAjax(val, member) {
            var d = new Date,
            dformat = [d.getFullYear().padLeft(),
                        (d.getMonth()+1).padLeft(),
                        d.getDate(),
                        ].join('-')+
                    ' ' +
                    [ d.getHours().padLeft(),
                        d.getMinutes().padLeft(),
                        d.getSeconds().padLeft()].join(':');

            $.ajax({
                type: "POST",
                url: "https://messaging.homedoc.fr/message",
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: JSON.stringify({ uid: uid, message: {type: "text", member: member, text: val, date: dformat, read: false} }),
                success: function(data) {
                    $('#body-chat').scrollTop($('#body-chat')[0].scrollHeight);

                    console.log(data);
                },
                error: function() {

                }
            });
        }

        function send() {

            var text = $("#input").val();
            doRequestAjax(text, memberId);
            setDemand(text);
            //  setResponse("...");
        }

        function  setDemand(val) {
            $("#input").val("");
            var div = document.createElement("div");
            div.className = "demand";
            var txt = document.createTextNode(val);
            div.appendChild(txt);
            document.getElementById("body-chat").appendChild(div);
        }
        function setResponse(val) {
            $("#input").val("");
            var div = document.createElement("div");
            div.className = "answer";
            var txt = document.createTextNode(val);
            div.appendChild(txt);
            document.getElementById("body-chat").appendChild(div);
        }

        function setPicture(val) {
            var div = document.createElement("div");
            div.className = "answer-card img-modal";
            var img = document.createElement("img");
            img.style = "width : 100%;";
            img.src = "data:image/png;base64, " + val;
            img.onclick = function () {
                $('#myModal').modal();
                $('#imgModal').prop('src', img.src);
            };
            div.appendChild(img);
            document.getElementById("body-chat").appendChild(div);
        }

        function setPictureDemand(val) {
            var div = document.createElement("div");
            div.className = "demand-card img-modal";
            var img = document.createElement("img");
            img.style = "width : 100%;";
            img.src = "data:image/png;base64, " + val;
            img.onclick = function () {
                $('#myModal').modal();
                $('#imgModal').prop('src', img.src);
            };
            div.appendChild(img);
            document.getElementById("body-chat").appendChild(div);
        }
    </script>
@endsection
