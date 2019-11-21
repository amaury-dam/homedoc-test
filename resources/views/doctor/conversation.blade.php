@extends('doctor/coreMenu')

@section('content')
    <div class="container">
        <div class="page-surroundings">
            <div style="height: 80px; border-bottom: 1px solid #e6ecf0;">
                <div style="float: left; width: 10%; height: 100%; display: flex; align-items: center; justify-content: center;">
                    <img style="display: flex; align-items: center; justify-content: center;" alt="logo" height="60" src="/ressources/logo-petit.png">
                </div>
                <div style="float: left; width: 80%; height: 100%; display: flex; align-items: center; justify-content: left;">
                    <h3 style="color:#343a40; font-weight: bold; font-size: 18px;">Home'Doc</h3>
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
    <div class="modal" id="doctorView" tabindex="-1" role="dialog">
        <input id="doctor_id" type="hidden" value="">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Contacter un médecin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">

                </div>
                <div class="modal-footer justify-content-center">
                    <button id="contact" type="button" class="btn btn-primary new-conversation" style="border-radius: 50px; color: white; background-color: #4c934c; border-color: #4c934c;">Contacter</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var uid = "<?php echo $conversationId ?>";
        var memberId = "<?php echo $memberId ?>";
        console.log(uid, memberId);
        var accessToken = "4f73c79425254a63a38ad7537647b11d";
        var baseUrl = "https://api.api.ai/v1/";


        Number.prototype.padLeft = function(base,chr){
            var  len = (String(base || 10).length - String(this).length)+1;
            return len > 0? new Array(len).join(chr || '0')+this : this;
        };

        $( "#delete" ).click(function() {
            $.ajax({
                type: "POST",
                url: "/doctor/deleteConversation",
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: JSON.stringify({ uid: uid}),
                success: function(data) {
                    location.href = "/doctor/messaging";
                },
                error: function() {

                }
            });
        });

        $(document).ready(function() {

            $.ajax({
                type: "GET",
                url: "https://messaging.homedoc.fr/conversation/" + uid,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    for (i = 0; i < data.conversation.messages.length; i++) {
                        console.log(data.conversation.messages[i]);
                        if (data.conversation.messages[i].member === "000000000000000000000001")
                            if (data.conversation.messages[i].type === "card") {
                                setCard(data.conversation.messages[i].text);
                            } else if (data.conversation.messages[i].type === "list") {
                                setDoctorsList(data.conversation.messages[i].text);
                            } else {
                                setResponse(data.conversation.messages[i].text);
                            }
                        else
                            setDemand(data.conversation.messages[i].text);
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
                data: JSON.stringify({ uid: uid, message: {type: "text", member: member, text: val, date: dformat} }),
                success: function(data) {
                    console.log(data);
                },
                error: function() {

                }
            });
        }

        function doRequestAjaxObject(val, member, type) {
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
                data: JSON.stringify({ uid: uid, message: {type: type, member: member, text: val.google, date: dformat} }),
                success: function(data) {
                    console.log(data);
                },
                error: function() {

                }
            });
        }

        function setInput(text) {
            $("#input").val(text);
            send();
        }


        function send() {

            var text = $("#input").val();
            doRequestAjax(text, memberId);

            setDemand(text);
            $.ajax({
                type: "POST",
                url: baseUrl + "query?v=20150910",
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                headers: {
                    "Authorization": "Bearer " + accessToken
                },
                data: JSON.stringify({ query: text, lang: "en", sessionId:  uid}),
                success: function(data) {
                    if (data.result.metadata.intentName === "learn_more") {
                        setCard(data.result.fulfillment.data.google);
                        doRequestAjaxObject(data.result.fulfillment.data, "000000000000000000000001", "card");
                    } else if (data.result.metadata.intentName === "doctors_list") {
                        setDoctorsList(data.result.fulfillment.data.google);
                        doRequestAjaxObject(data.result.fulfillment.data, "000000000000000000000001", "list");
                    } else {
                        var respText = data.result.fulfillment.speech;
                        setResponse(respText);
                        doRequestAjax(respText, "000000000000000000000001");
                    }
                $("#input").val("");
                $('#body-chat').scrollTop($('#body-chat')[0].scrollHeight);
                },
                error: function() {
                    setResponse("Internal Server Error");
                }
            });
            //  setResponse("...");
        }

        $( "#contact" ).click(function() {
            $.ajax({
                type: "POST",
                url: "/patient/createConversation",
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: JSON.stringify({ doctor_id : $("#doctor_id").val(), type : "doctor"}),
                success: function(data) {
                    $('#doctorView').modal('hide');
                    location.href='/patient/messaging/' + data.uid;
                },
                error: function() {

                }
            });
        });

        function setDoctorsList(val) {
            var div = document.createElement("div");
            div.className = "card answer-list";
            div.style = "text-align: left; !important";
            var divheader = document.createElement("div");
            var txtheader = document.createTextNode(val.richResponse.items[0].simpleResponse.textToSpeech + " :");
            divheader.appendChild(txtheader);
            div.appendChild(divheader);
            val.systemIntent.data.listSelect.items.forEach(function(element) {
                console.log(element);
                var elementList = document.createElement("div");
                var txt = document.createTextNode(element.title);
                elementList.onclick = function () {
                    $("#modal-body").html("Voulez-vous rentrer en contact avec le médecin " + element.title);
                    $("#doctor_id").val(element.optionInfo.key);
                    $('#doctorView').modal('show')
                };
                elementList.className = "item-list-doctors";
                elementList.appendChild(txt);
                div.appendChild(elementList);
            });
            document.getElementById("body-chat").appendChild(div);
        }

        function setCard(val) {
            let url = "/patient/fiches/" + val.richResponse.items[1].basicCard.title.toLowerCase();
            $("#body-chat").append(
                "<div class='card answer-card'>" +
                    "<img class='card-img-top' style='border-radius: 5px;' src='" + val.richResponse.items[1].basicCard.image.url + "'>" +
                    "<div class='card-body' style='padding-bottom: 0;'>" +
                        "<h5>" + val.richResponse.items[1].basicCard.title + "</h5>" +
                        "<p class='card-text'>" + val.richResponse.items[0].simpleResponse.textToSpeech + "</p>" +
                        "<a class='btn btn-light' href='" + url + "'>" + val.richResponse.items[1].basicCard.buttons[0].title + "</a>" +
                    "</div>" +
                "</div>");
        }

        function  setDemand(val) {
            $("#body-chat").append(
                "<div class='demand'>" + val + "</div>");
        }
        function setResponse(val) {
            $("#body-chat").append(
                "<div class='answer'>" + val + "</div>");
        }
    </script>
@endsection