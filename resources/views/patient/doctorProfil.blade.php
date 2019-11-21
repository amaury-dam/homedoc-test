@extends('patient/coreMenu')

@section('content')
    <div class="container">
        <div class="page-surroundings" style="border-radius: 10px">
            <div>
                <div style="padding-top: 30px; height: 100%; display: flex; align-items: center; justify-content: center;">
                    <img style="display: flex; align-items: center; justify-content: center;" alt="logo" height="100" src="/ressources/logo-medecin2.jpg">
                </div>
                <div style="padding-top: 30px;display: flex;align-items: center; justify-content: center;">
                    <h3 style="color:#343a40; font-weight: bold; font-size: 18px;">Docteur {{$profil['lastname']}} {{ $profil['firstname'] }}</h3>
                </div>
            </div>
            <div class="item-profil-surroundings" style="padding-top: 30px">
                <div class="item-profil">
                    <div class="item-profil-title">Nom</div>
                    <div class="item-profil-data">{{ $profil['lastname'] }}</div>
                </div>
                <div class="item-profil">
                    <div class="item-profil-title">Prénom</div>
                    <div class="item-profil-data">{{ $profil['firstname'] }}</div>
                </div>
            </div>
            <div class="item-profil-surroundings">
                <div class="item-profil">
                    <div class="item-profil-title">Ville</div>
                    @if(isset ($profil['city']))
                    <div class="item-profil-data">{{ $profil['city'] }}</div>
                    @endif
                </div>
                <div class="item-profil">
                    <div class="item-profil-title">Date de naissance</div>
                    <div class="item-profil-data">{{ date("d-m-Y", strtotime($profil['dateOfBirth'])) }}</div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection