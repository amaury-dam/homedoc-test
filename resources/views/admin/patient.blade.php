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
                    <th scope="col">ville</th>
                    <th scope="col">date de naissance</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($userList as $users)
                    <tr>
                        <td>{{ $users['lastname'] }}</td>
                        <td>{{ $users['firstname'] }}</td>
                        @if (isset($users['city']))
                        <td>{{ $users['city'] }}</td>
                        @else
                            <td>N/A</td>
                        @endif
                        @if (isset($users['dateOfBirth']))
                        <td>{{ $users['dateOfBirth'] }}</td>
                        @else
                            <td>N/A</td>
                        @endif



                    </tr>

                @endforeach


                </tbody>
            </table>


        @endsection
    </body>
</html>
