@extends('patient/core')

@section('body')
    <div class="container login-box">
        <div class="row">
            <div class="col-md-4 login-sec">
                <div style="text-align: center; padding: 20px; border-bottom: 1px solid rgba(0,0,0,.125);">
                    <img style="height: 100px;" src="{{url("/ressources/logo-petit.png")}}">
                    <h2>Inscription</h2>
                    @if(count($errors))
                        <div class="alert alert-danger" style="font-size: 12px; text-align: left;">
                            Veuillez remplir tous les champs obligatoires avant d'envoyer le formulaire.
                            <br/>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                        </div>

                    @endif
                </div>
                <form method="post" style="padding: 20px;" class="login-form" action="{!! url('patient/register') !!}">

                    <div class="form-group">
                        <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Nom">
                    </div>
                    <div class="form-group">
                        <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Prénom">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Mot de passe">
                    </div>
                    <div class="form-group">
                        <input type="date" name="dateOfBirth" class="form-control" id="dateOfBirth">
                    </div>
                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-dark"><i class="fas fa-edit"></i> S'inscrire</button>
                    </div>
                </form>
            </div>
            <div class="col-md-8 banner-sec-patient">
            </div>
        </div>
    </div>
@endsection