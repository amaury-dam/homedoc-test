@extends('patient/core')

@section('body')

            <div class="container login-box">
                <div class="row">
                    <div class="col-md-4 login-sec">
                        <div style="text-align: center; padding: 20px; border-bottom: 1px solid rgba(0,0,0,.125);">
                            <img style="height: 100px;" src="{{url("/ressources/logo-petit.png")}}">
                            <h2>Espace patient</h2>
                            @if (count($errors))

                                <div class="alert alert-danger" style="font-size: 12px;">
                                   Indentifiant Invalide
                                </div>

                            @endif
                        </div>
                        <form method="post" style="padding: 20px; border-bottom: 1px solid rgba(0,0,0,.125);" class="login-form" action="{!! url('patient/login') !!}">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Mot de passe">
                            </div>
                            <div style="text-align: center;">
                                <button type="submit" class="btn btn-dark"><i class="fas fa-sign-in-alt"></i> Connexion</button>
                            </div>
                        </form>
                        <div style="text-align: center;">
                            <a class="btn btn-dark"  href="{{ url('patient/register') }}"  style="margin-top: 15px;" ><i class="fas fa-edit"></i> S'inscrire</a>
                        </div>
                    </div>
                    <div class="col-md-8 banner-sec-patient">
                    </div>
                </div>
            </div>
@endsection