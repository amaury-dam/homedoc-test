
@extends('doctor/coreMenu')

@section('content')
    <div class="container">
        <div style="margin-top: 150px; text-align: center;">
        <button type="button" onclick="location.href='{{ url('doctor/wikicreate') }}'"  class="button-blue btn" ><i class="fas fa-briefcase-medical"></i>  Ajouter une fiche maladie</button>
        </div>
        <div  style="margin-top: 50px; text-align: center; box-shadow: 0 3px 6px rgba(0,0,0,.16),0 3px 6px rgba(0,0,0,.23); padding-bottom: 0px;">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Maladie</th>
                    <th style="text-align: center">Consulter</th>
                    <th style="text-align: center">Editer</th>
                    <th style="text-align: center">Supprimer</th>
                </tr>
                </thead>
                <tbody id="delete">
                        @for ($i = 0; $i < count($sickness); $i++)
                            <tr id="line">
                                <form method="POST" action="{!! url('patient/fiches') !!}" >
                                    <select name="sickness" class="form-control" id="sickness" style="display: none">
                                        <option>{{ $sickness[$i]['nom'] }}</option>
                                    </select>
                        <td id="sickness">{{ $sickness[$i]['nom'] }}</td>
                        <td style="text-align: center">
                            <button type="submit" class="btn btn-primary">Visualiser</button>
                                </form>
                            <form method="POST"  action="{!! url('doctor/editWiki') !!}" >
                                <select name="sickness" class="form-control" id="sickness" style="display: none">
                                    <option>{{ $sickness[$i]['nom'] }}</option>
                                </select>
                                <td style="text-align: center">
                            <button type="submit" class="btn btn-success">Modifier</button>
                            </form>
                                <form method="POST"  action="{!! url('doctor/wiki') !!}" >
                                    <select name="id" class="form-control" id="id" style="display: none">
                                        <option>{{ $sickness[$i]['_id'] }}</option>
                                    </select>
                                    <td style="text-align: center">
                            <a type="submit" class="btn btn-danger">Supprimer</a>
                                </td>
                            </form>
                        </td>

                    </tr>
                        @endfor
                </tbody>
            </table>
    </div>
    </div>
    <script>
        $(document).ready(function () {
            $( "#delete" ).on("click", "a", function(event) {
            console.log("del");
            $("#line").remove();
        });
        });
    </script>
@endsection

