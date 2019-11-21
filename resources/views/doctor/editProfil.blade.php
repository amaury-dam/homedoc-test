@extends('doctor/coreMenu')

@section('content')
    <div class="container">
        <div style="margin-top: 90px; text-align: center; box-shadow: 0 3px 6px rgba(0,0,0,.16),0 3px 6px rgba(0,0,0,.23); padding-bottom: 20px;">
            <div>
                <img style="width: 100%;" src="{{url('/ressources/test.jpg')}}">
            </div>
            <form style="padding-top: 10px; margin-left: 30px; margin-right: 30px;" method="POST" action="{!! url('doctor/editProfil') !!}" >
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
                        <label for="city">Ville</label>
                        <input type="text" name="city" class="form-control" placeholder="City" value="{{ $userData['city'] }}" required>
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6" style="text-align: left; font-weight: bold;">
                        <label for="dateOfBirth">Date de naissance</label>
                        <input type="text" name="dateOfBirth" class="form-control" placeholder="dateOfBirth" value="{{ $userData['dateOfBirth'] }}" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-dark"><i class="far fa-edit"></i> Valider</button>
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