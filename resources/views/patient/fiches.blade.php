@extends('patient/coreMenu')

@section('content')
    <div class="container">
        <div class="page-surroundings">
            <div class="conversations-header">
                <div style="float: left; width: 70%; height: 100%; display: flex; align-items: center; justify-content: left;">
                    <h2 class="private-messages">Fiches</h2>
                </div>
            </div>
            <div>
                <form method="POST" action="{!! url('patient/fiches') !!}" style="margin: 15px;">
                    <div class="form-group">
                        <label for="sickness" style="font-weight: bold;">Sélectionnez une maladie</label>
                        <select name="sickness" class="form-control" id="sickness">
                            @for ($i = 0; $i < count($sickness); $i++)
                                <option>{{ str_replace("_", " ", $sickness[$i]['nom'])}}</option>
                            @endfor
                        </select>
                    </div>
                    <div style="text-align: center;">
                        <button type="submit" class="btn new-conversation" style="background-color: #4c934c; color: white; text-align: center;"><i class="fas fa-search"></i> Rechercher</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection
