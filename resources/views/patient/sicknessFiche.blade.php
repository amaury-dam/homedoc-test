@extends('patient/coreMenu')

@section('content')
    <div class="container">
        <div class="page-surroundings">
            <div class="fiche-header">
                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                    <h1 class="private-messages" style="font-size: 30px ;text-align: center ;text-transform: uppercase;">{{ str_replace("_", " ", $sickness[0]['nom']) }}</h1>
                </div>
            </div>
            <div style="margin: 15px; font-size: 20px;">
                <div class="row">
                    <div class="col-4 col-xl-4 col-lg-4 col-md-4 col-sm-4" style="display: flex; align-items: center;">
                        <img width="100%"  src="{{ "/ressources/maladies/" . $sickness[0]['nom'] . ".png"}}"/>
                    </div>
                    <div class="col-8 col-xl-8 col-lg-8 col-md-8 col-sm-8">
                        <h5 style="margin-top: 20px; color: #2a9055;font-weight: bold;display: flex; justify-content: center;">Description</h5>
                        <p>{{ $sickness[0]['description'] }}</p>
                        <br>
                        <div class="row">
                            <div class="col-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <h5 style=" color: #2a9055 ;display: flex; justify-content: center;font-weight: bold;">Symptômes</h5>
                                @if (isset($sickness[0]['symptomes']))
                                    @for ($i = 0; $i < count($sickness[0]['symptomes']); $i++)
                                        <i style="display: flex; justify-content: center">{{$sickness[0]['symptomes'][$i]}}</i>
                                    @endfor
                                @endif
                            </div>
                            <div class="col-6 col-xl-6 col-lg-6 col-md-6 col-sm-6" style="text-align: center;">
                                @if (isset($sickness[0]['incubationPeriode']))
                                    <h5 style="color: #2a9055;display: flex; justify-content: center; font-weight: bold">Période d'incubation</h5>
                                    <div><strong>{{$sickness[0]['incubationPeriode']['debut']}}</strong>   à  <strong>{{$sickness[0]['incubationPeriode']['fin']}}</strong> jours d'incubation</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
@endsection
