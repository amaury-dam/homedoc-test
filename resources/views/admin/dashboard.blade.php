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
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Spécialité</th>
                    <th scope="col">RPPS</th>
                    <th scope="col">Valider</th>
                    <th scope="col">Voir le profil</th>
                </tr>
                </thead>
                <tbody>


                @foreach ($doctorsList as $doctor)
                    <tr>
                        <td>{{ $doctor['lastname'] }}</td>
                        <td>{{ $doctor['firstname'] }}</td>
                        @if (isset($doctor['speciality']))
                            <td>{{ $doctor['speciality'] }}</td>
                        @else
                            <td>N/A</td>
                        @endif
                        @if (isset($doctor['rpps']))
                            <td>{{ $doctor['rpps'] }}</td>
                        @else
                            <td>N/A</td>
                        @endif
                        @if (isset($doctor['isValid']) && $doctor['isValid'] == true)
                            <td><button class="btn-success">VALIDER</button></td>
                        @elseif (isset($doctor['isValid']) && $doctor['isValid'] == false)
                            <td><button class="btn-danger">EN ATTENTE </button></td>
                        @else
                            <td>N/A</td>
                        @endif
                        <td> <div style="width: 20%">
                                <button onclick="joinDoctorProfil('{{ $doctor['_id'] }}')" class="btn-dark" style="border-radius: 0px">Profil</button>
                            </div></td>
                    </tr>

                @endforeach
                </tbody>
            </table>


        @endsection
    </body>
<script>
    function joinDoctorProfil(doctorId) {
        location.href='/admin/doctorProfil/' + doctorId;

    }
</script>
</html>
