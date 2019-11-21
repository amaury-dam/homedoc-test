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
            @foreach ($doctorsList as $doctor)
                @for ($i = 0; $i < count($doctor); $i++)
                @endfor

            @endforeach

            @foreach ($userList as $users)
                @for ($j = 0; $j < count($users); $j++)
                @endfor

            @endforeach

            <h1 style="display: flex; justify-content: center ;color: #23272b;"> Statistiques</h1>
            <div class="container-fluide" style="margin-top:20px; background-color: #23272b; height: 250px">
                <div class="row">
                    <div class="col-md-6" style="padding-top: 30px">
                        <label  style="display: flex; justify-content: center; color: whitesmoke">Nombre de médecins inscrit</label>
                        <div class="circle_two">
                            <div class="text_circle">
                                {{ count($doctorsList)  }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding-top: 30px">
                        <label  style="display: flex; justify-content: center; color: whitesmoke">Nombre d'utilisateurs inscrit</label>
                        <div class="circle_two">
                            <div class="text_circle">
                                {{ count($userList) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>






        @endsection
    </body>
</html>
