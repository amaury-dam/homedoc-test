@extends('patient/coreMenu')

@section('content')
    <div class="container">
        <div class="page-surroundings">
            <div class="conversations-header">
                <div style="float: left; width: 70%; height: 100%; display: flex; align-items: center; justify-content: left;">
                    <h2 class="private-messages">Edition de profil</h2>
                </div>
                <div style="float: left; width: 30%; height: 100%; display: flex; align-items: center; justify-content: right;">
                    <a class="btn new-conversation" style="border-radius: 50px; color: white; background-color: #4c934c;" onclick="location.href='/patient/editPassword';">Editer mot de passe</a>
                </div>
            </div>
            <form style="padding-top: 10px; margin-left: 30px; margin-right: 30px;" method="POST" action="{!! url('patient/editProfil') !!}" >
                <div class="form-row">
                    <div class="form-group col-md-6" style="text-align: left; font-weight: bold;">
                        <label for="lastname">Nom</label>
                        <input type="text" name="lastname" class="form-control" placeholder="Nom" value="{{ $userData['lastname'] }}" required>
                    </div>
                    <div class="form-group col-md-6" style="text-align: left; font-weight: bold;">
                        <label for="firstname">Prénom</label>
                        <input type="text" name="firstname" class="form-control" placeholder="Prénom" value="{{ $userData['firstname'] }}" required>
                    </div>
                </div>
                <div class="form-row">

                    <div class="form-group col-md-6" style="text-align: left; font-weight: bold;">
                        <label for="email">Adresse mail</label>
                        <input type="text" name="email" class="form-control" placeholder="Adresse mail" value="{{ $userData['email'] }}" required>
                    </div>
                    <div class="form-group col-md-6" style="text-align: left; font-weight: bold;">
                        <label for="dateOfBirth">Date de naissance</label>
                        <input type="date" name="dateOfBirth" class="form-control" value="{{ date( "Y-m-d", strtotime($userData['dateOfBirth'] ))}}" required>
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-4" style="text-align: left; font-weight: bold;">
                        <label for="gender">Genre</label>
                        <select name="gender" class="custom-select" id="gender">
                            @if (isset($userData['gender']))

                                @if ($userData['gender'] == "male")
                                    <option selected="selected" value="male">Homme</option>
                                @else
                                    <option value="male">Homme</option>
                                @endif
                                @if ($userData['gender'] == "female")
                                    <option selected="selected" value="female">Femme</option>
                                @else
                                    <option value="female">Femme</option>
                                @endif
                                @if ($userData['gender'] == "other")
                                    <option selected="selected" value="other">Autre</option>
                                @else
                                    <option value="other">Autre</option>
                                @endif
                            @else
                                <option value="male">Homme</option>
                                <option value="female">Femme</option>
                                <option value="other">Autre</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-4" style="text-align: left; font-weight: bold;">
                        <label for="height">Taille</label>
                        <input type="number" name="height" class="form-control" placeholder="0" value="{{ (isset($userData['height']) ? $userData['height'] : "0") }}" >
                    </div>
                    <div class="form-group col-md-4" style="text-align: left; font-weight: bold;">
                        <label for="weight">Poids</label>
                        <input type="number" name="weight" class="form-control" placeholder="0" value="{{ (isset($userData['weight']) ? $userData['weight'] : "0") }}" >
                    </div>
                    <div class="form-group col-md-6" style="text-align: left; font-weight: bold;">
                        <label for="allergies">Allergies</label>
                        <br>
                        @if (isset($userData['allergies']))
                            <div id="allergies">
                                <div id="all"></div>
                                @foreach ($userData['allergies'] as $allergy)
                                    <div>
                                        <input style="float: left; width: 85%; margin-bottom: 10px;" class="form-control" type="text" name="allergies[]" value="{{ $allergy }}" readonly>
                                        <a style="float: right;" class="btn btn-danger" id="delAllergie"><i class="far fa-trash-alt" style="color: white;"></i></a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <input style="float: left; width: 85%; margin-bottom: 10px;" id="allergie" class="form-control" type="text" name="allergies[]" placeholder="Allergie">
                        <a style="float: right;" class="btn btn-success" id="addAllergie"><i class="far fa-plus-square" style="color: white;"></i></a>
                    </div>
                    <div class="form-group col-md-6" style="text-align: left; font-weight: bold;">
                        <label for="medicalHistory">Conditions Médicales</label>
                        <br>
                        @if (isset($userData['medicalHistory']))
                            <div id="medicals">
                                <div id="med"></div>
                                @foreach ($userData['medicalHistory'] as $history)
                                    <div id="med">
                                        <input style="float: left; width: 85%; margin-bottom: 10px;" class="form-control" type="text" name="medicalHistory[]" value="{{ $history }}" readonly>
                                        <a style="float: right;" class="btn btn-danger" id="delMedical"><i class="far fa-trash-alt" style="color: white;"></i></a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <input style="float: left; width: 85%; margin-bottom: 10px;" id="medical" type="text" name="medicalHistory[]" class="form-control" placeholder="Conditions médicales">
                        <a style="float: right;" class="btn btn-success" id="addMedical"><i class="far fa-plus-square" style="color: white;"></i></a>
                    </div>
                </div>
                <div style="text-align: center;">
                    <button type="submit" class="btn new-conversation" style="background-color: #4c934c; color: white; text-align: center;"><i class="far fa-edit"></i> Valider</button>
                </div>

            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            //your code here
            $( "#medicals" ).on( "click", "a", function(event) {
                console.log("del");
                $(this).parent().remove();
            });
            $( "#allergies" ).on( "click", "a", function(event) {
                $(this).parent().remove();
            });

            $( "#addAllergie" ).click(function(event) {
                $("#all").after("<div><input style=\"float: left; width: 85%; margin-bottom: 10px;\" type=\"text\" name=\"allergies[]\" class=\"form-control\" placeholder=\"Conditions médicales\" value=\"" +   $( "#allergie" ).val() + "\" readonly>" +
                    "                        <a style=\"float: right;\" class=\"btn btn-danger\" id=\"delAllergie\"><i class=\"far fa-trash-alt\" style=\"color: white;\"></i></a></div>");
                $( "#allergie" ).val("");
            });


            $( "#addMedical" ).click(function(event) {
                $("#med").after("<div><input style=\"float: left; width: 85%; margin-bottom: 10px;\" type=\"text\" name=\"medicalHistory[]\" class=\"form-control\" placeholder=\"Conditions médicales\" value=\"" +   $( "#medical" ).val() + "\" readonly>" +
                    "                        <a style=\"float: right;\" class=\"btn btn-danger\" id=\"delMedical\"><i class=\"far fa-trash-alt\" style=\"color: white;\"></i></a></div>");
                $( "#medical" ).val("")
            });
        });

    </script>

@endsection