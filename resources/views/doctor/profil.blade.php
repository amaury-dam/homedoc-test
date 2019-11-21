
@extends('doctor/coreMenu')

@section('content')
    <div class="container">
        @if (session()->has('message'))
<!--            <p style="text-align: center;" class="alert alert-success">{{ session()->get('message') }}</p> -->

        @endif
            <div class="page-surroundings">
                <div class="conversations-header">
                    <div style="float: left; width: 70%; height: 100%; display: flex; align-items: center; justify-content: left;">
                        <h2 class="private-messages">Profil</h2>
                    </div>

                </div>
                <div style="padding-top: 10px;">
                    <div class="item-profil-surroundings">
                        <div class="item-profil-doctor">
                            <div class="item-profil-title-doctor">Nom</div>
                            <div class="item-profil-data">{{ $userData['lastname'] }}</div>
                        </div>
                        <div class="item-profil-doctor">
                            <div class="item-profil-title-doctor">Prénom</div>
                            <div class="item-profil-data">{{ $userData['firstname'] }}</div>
                        </div>
                    </div>
                    <div class="item-profil-surroundings">
                        <div class="item-profil-doctor">
                            <div class="item-profil-title-doctor">Adresse e-mail</div>
                            <div class="item-profil-data">{{ $userData['email'] }}</div>
                        </div>
                        <div class="item-profil-doctor">
                            <div class="item-profil-title-doctor">Date de naissance</div>
                            <div class="item-profil-data">{{ date("d-m-Y", strtotime($userData['dateOfBirth'])) }}</div>
                        </div>
                    </div>
            <div style="padding-top: 30px;">
                <button style="float: left; margin-left: 40px;" type="button" onclick="location.href='{{ url('doctor/editProfil') }}'" class="btn btn-dark">Modifier profil</button>
                <button style="float: right; margin-right: 40px;" type="button" onclick="location.href='{{ url('doctor/editPassword') }}'" class="btn btn-dark">Modifier mot de passe</button>
            </div>
        </div>

            <div style="clear: both"></div>
        </div>
    </div>

@endsection
<script>

    /*$("#delete").click(function(){

    });*/
</script>
