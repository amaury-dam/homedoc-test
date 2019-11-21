@extends('patient/coreMenu')

@section('content')
    <div class="container">
        <div class="page-surroundings">
            <div class="conversations-header">
                <h2 class="private-messages">Nouvelle conversation</h2>
            </div>
            <div style="height: 300px;  padding-bottom: 20px; padding-top: 20px;">
                <div style="height: 100%; width: 50%; display: flex; align-items: center; justify-content: center; float: left;">
                    <img class="logo-homedoc" alt="logo-homedoc" id="logo-homedoc" src="/ressources/logo-moyen.png">
                </div>
                <div style="height: 100%; width: 50%; display: flex; align-items: center; float: left; justify-content: center;">
                    <img class="logo-medecin" alt="logo-medecin" src="/ressources/logo-medecin2.jpg" onclick="location.href='/patient/doctorsList';">
                </div>

            </div>

        </div>
    </div>
    <script>
        $( "#logo-homedoc" ).click(function() {
            $.ajax({
                type: "POST",
                url: "/patient/createConversation",
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: JSON.stringify({ type: "homedoc"}),
                success: function(data) {
                    location.href='/patient/messaging/' + data.uid + '/homedoc';
                },
                error: function() {

                }
            });
        });
    </script>
@endsection