@extends('doctor/core')

@section('body')
    <div class="container login-box">
        <div class="row">
            <div class="col-md-4 login-sec">
                <div style="text-align: center; padding: 20px; border-bottom: 1px solid rgba(0,0,0,.125);">
                    <img style="height: 100px;" src="{{url("/ressources/logo-petit.png")}}">
                </div>
                <form method="post" style="padding: 20px;" class="login-form" action="{!! url('doctor/register') !!}">
                    @if(count($errors))

                        <div class="alert alert-danger">

                            <strong>Whoops!</strong> There were some problems with your input.

                            <br/>

                            <ul>

                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif
                    <div class="form-group">
                        <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Prénom *" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Nom *" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email *" required>
                    </div>
                        <div class="form-group">
                            <label for="speciality" style="font-weight: bold;">Sélectionnez une spécialité</label>
                            <select  name="speciality" class="form-control" id="speciality">
                                @for ($i = 0; $i < count($speciality); $i++)
                                    <option>{{$speciality[$i]}}</option>
                                @endfor
                            </select>
                        </div>
                    <!--<div class="form-group">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Mot de passe *" required>
                    </div>-->
                        <div class="form-group">
                            <input type="text" name="rpps" class="form-control" id="rpps" placeholder="RPPS *" required>
                        </div>
                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-dark"><i class="fas fa-edit"></i> S'inscrire</button>
                    </div>
                </form>
            </div>
            <div class="col-md-8 banner-sec-doctor">
            </div>
        </div>
    </div>
@endsection