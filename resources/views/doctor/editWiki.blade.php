
@extends('doctor/coreMenu')

@section('content')
    <div>
        <h2 style="text-align: center; margin-top: 90px">Création de la fiche maladie</h2>
    </div>
    <div class="container">
        <form style="padding-top: 10px; margin-left: 30px; margin-right: 30px;" method="POST" action="{!! url('doctor/sendEditWiki') !!}" >
        <div style="margin-top: 30px;margin-bottom: 30px; text-align: center; box-shadow: 0 3px 6px rgba(0,0,0,.16),0 3px 6px rgba(0,0,0,.23); padding-bottom: 20px;">
            <input type="hidden" name="id" value="{{$sickness[0]['_id']}}">
                <div class="form-group" style="padding: 10px">
                <label for="titre">Titre :</label>
                <input name="nom" type="titre" class="form-control" value="{{$sickness[0]['nom']}}" id="titre">
            </div>
                <div class="form-group" style="padding: 10px">
                    <label for="symptome">Symptômes :</label>
                    @for ($i = 0; $i < count($sickness[0]['symptomes']); $i++)
                    <input name="symptomes[]" value="{{$sickness[0]['symptomes'][$i]}}" class="form-control" id="symptome">
                @endfor
                </div>
            <div class="form-group" style="padding: 10px">
                <label for="pronom">Pronom :</label>
                <input name="pronom"  class="form-control" value="{{$sickness[0]['pronom']}}" id="pronom">
            </div>
            <div class="form-group" style="padding: 10px">
                <label for="description">Description :</label>
                <textarea name="description" class="form-control" name="text_preparation" rows="5" id="text_preparation" >{{ $sickness[0]['description'] }}</textarea>
            </div>
                <button type="submit" class="btn btn-danger">Envoyer</button>
        </div>
        </form>
    </div>

@endsection

