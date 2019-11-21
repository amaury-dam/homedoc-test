@extends('patient/coreMenu')

@section('content')
    <div class="container">
        <div class="page-surroundings">
            <div class="conversations-header">
                <div style="float: left; width: 70%; height: 100%; display: flex; align-items: center; justify-content: left;">
                    <h2 class="private-messages">Liste de médecins disponibles</h2>
                </div>
            </div>
            <ul style="list-style: none; padding: 0;">

                <li>
                    @foreach ($doctorsList as $doctor)
                        <div class="conversations-item">
                            <div style=" width: 10%;display: flex; align-items: center; justify-content: center;">
                                <img style="display: flex; align-items: center; justify-content: center;" alt="logo" height="60" src="/ressources/logo-medecin2.jpg">
                            </div>
                            <div style="width: 50%; display: flex; flex-direction: column;">
                                <div><strong>{{$doctor['firstname']}}</strong></div>
                                <div style="font-size: 14px;">{{$doctor['lastname']}}</div>
                            </div>
                            <div style="width: 20%">
                                <button onclick="joinDoctor('{{ $doctor['_id'] }}')" class="btn-primary" style="border-radius: 10px">ouvrir une conversation</button>
                            </div>
                            <div style="width: 20%">
                                <button onclick="joinDoctorProfil('{{ $doctor['_id'] }}')" class="btn-primary" style="border-radius: 10px">Voir le profil</button>
                            </div>
                        </div>
                    @endforeach
                </li>
            </ul>
        </div>
    </div>
    <script>
        function joinDoctor(doctorId) {
            $.ajax({
                type: "POST",
                url: "/patient/createConversation",
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: JSON.stringify({ doctor_id : doctorId, type : "doctor"}),
                success: function(data) {
                    location.href='/patient/messaging/' + data.uid;
                },
                error: function() {

                }
            });
        }

        function joinDoctorProfil(doctorId) {
                    location.href='/patient/doctorProfil/' + doctorId;

        }
    </script>
@endsection