<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    @include('admin/header')

</head>
<body>

@extends('admin/menu')

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
                <div class="item-profil">
                    <div class="item-profil-title">Date de naissance</div>
                    <div class="item-profil-data">{{ date("d-m-Y", strtotime($profil['isValid'])) }}</div>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <form method="POST" action="{!! url('admin/doctorProfil') !!}" >
                <label for="isValid"></label>
            <button type="submit" value="1"  class="btn-dark" style="margin-left: 20px">VALIDER LE DOCTEUR</button>
            </form>
        </div>
        <div class="col-md-6">
            <button class="btn-dark">DESINSCRIRE LE DOCTEUR</button>
        </div>
        </div>
    </div>
@endsection
</body>
