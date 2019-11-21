
@extends('doctor/coreMenu')

@section('content')
    <div>
        <h2 style="text-align: center; margin-top: 90px">Création de la fiche maladie</h2>
    </div>
    <div class="container">
        <form style="padding-top: 10px; margin-left: 30px; margin-right: 30px;" method="POST" action="{!! url('doctor/wikicreate') !!}" >
        <div style="margin-top: 30px;margin-bottom: 30px; text-align: center; box-shadow: 0 3px 6px rgba(0,0,0,.16),0 3px 6px rgba(0,0,0,.23); padding-bottom: 20px;">
                <div class="form-group" style="padding: 10px">
                    <label for="titre">Titre :</label>
                    <input  name="nom" type="titre" class="form-control" id="titre">
                </div>
            <div class="form-group" style="padding-left: 10px; ">
                <label for="symptome">Symptômes :</label>
                <div id="symptomes">
                    <div id="sym"></div>

                </div>

            <input style="float: left; margin-right: 10px; width: 85%;" id="symptome" type="text" name="symptomes[]" class="form-control" placeholder="Symptôme">
            <a style="float: left;" class="btn btn-success" id="addSymptome"><i class="far fa-plus-square" style="color: white; text-align: left"></i></a>
            </div>
            <div class="form-group" style="padding: 10px">
                <label for="pronom">Pronom  de la maladie: </label>
                <input name="pronom"  type="text" class="form-control" id="pronom">
            </div>
            <div class="form-group" style="padding: 10px">
                <label for="description">Description :</label>
                <textarea name="description" class="form-control" rows="5" id="text_preparation"></textarea>
            </div>
                <button type="submit" class="btn btn-danger">Envoyer</button>
        </div>
        </form>
    </div>

    <script>
        $(document).ready(function () {

                $("#symptomes").on("click", "a", function (event) {
                    $(this).parent().remove();
                });
                $("#addSymptome").click(function (event) {
                    $("#sym").after("<div><input style=\"float: left; width: 85%; margin-bottom: 10px; margin-right: 10px;\" type=\"text\" name=\"symptomes[]\" class=\"form-control\" placeholder=\"Symptôme\" value=\"" + $("#symptome").val() + "\" readonly>" +
                        "                        <a style=\"float: left;\" class=\"btn btn-danger\" id=\"delAllergie\"><i class=\"far fa-trash-alt\" style=\"color: white;\"></i></a></div>");
                    $( "#symptome" ).val("");
                });
        });
    </script>
@endsection

