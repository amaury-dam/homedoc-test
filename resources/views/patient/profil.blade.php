
@extends('patient/coreMenu')

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
                <div style="float: left; width: 30%; height: 100%; display: flex; align-items: center; justify-content: right;">
                    <a class="btn new-conversation" style="border-radius: 50px; color: white; background-color: #4c934c;" onclick="location.href='/patient/editProfil';">Editer profil</a>
                </div>

            </div>
            <div style="padding-top: 10px;">
                <div class="item-profil-surroundings">
                    <div class="item-profil">
                        <div class="item-profil-title">Nom</div>
                        <div class="item-profil-data">{{ $userData['lastname'] }}</div>
                    </div>
                    <div class="item-profil">
                        <div class="item-profil-title">Prénom</div>
                        <div class="item-profil-data">{{ $userData['firstname'] }}</div>
                    </div>
                </div>
                <div class="item-profil-surroundings">
                    <div class="item-profil">
                        <div class="item-profil-title">Adresse e-mail</div>
                        <div class="item-profil-data">{{ $userData['email'] }}</div>
                    </div>
                    <div class="item-profil">
                        <div class="item-profil-title">Date de naissance</div>
                        <div class="item-profil-data">{{ date("d-m-Y", strtotime($userData['dateOfBirth'])) }}</div>
                    </div>
                </div>
                <div class="item-profil-surroundings">
                    @if (isset($userData['gender']))
                        <div class="item-profil-33">
                            <div class="item-profil-title">Genre</div>
                            @if ($userData['gender'] == "male")
                                <div class="item-profil-data">Homme</div>
                            @elseif ($userData['gender'] == "female")
                                <div class="item-profil-data">Femme</div>
                            @else
                                <div class="item-profil-data">Autre</div>
                            @endif
                        </div>
                    @endif

                    @if (isset($userData['height']))
                        <div class="item-profil-33">
                            <div class="item-profil-title">Taille</div>
                            <div class="item-profil-data">{{ $userData['height'] }}</div>
                        </div>
                    @endif

                    @if (isset($userData['weight']))
                        <div class="item-profil-33">
                            <div class="item-profil-title">Poids</div>
                            <div class="item-profil-data">{{ $userData['weight'] }}</div>
                        </div>
                    @endif


                </div>
                <div class="item-profil-surroundings">
                    @if (isset($userData['allergies']))
                        <div class="item-profil">
                            <div class="item-profil-title">Allergies</div>
                            <div class="item-profil-data">
                                @foreach ($userData['allergies'] as $allergy)
                                    <div>{{ $allergy }}</div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if (isset($userData['medicalHistory']))
                        <div class="item-profil">
                            <div class="item-profil-title">Conditions médicales</div>
                            <div class="item-profil-data">
                                @foreach ($userData['medicalHistory'] as $history)
                                    <div>{{ $history }}</div>
                                @endforeach
                            </div>

                        </div>
                    @endif
                </div>

            </div>
          <!--  <div>
                <button style="float: right; margin-right: 40px;" type="button" onclick="location.href='{{ url('patient/editPassword') }}'" class="btn btn-dark"> Modifier mot de passe</button>
            </div>-->
            <div style="clear: both"></div>
        </div>
       <!-- <button type="button" id="delete" class="btn btn-danger">Supprimer compte</button>-->
    </div>

@endsection
<script>

    /*$("#delete").click(function(){

    });*/
</script>
