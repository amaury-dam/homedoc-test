@extends('doctor/core')

@section('body')
    <div class="container login-box">
        <div class="row">
            <div class="col-md-4 login-sec">
                <div style="text-align: center; padding: 20px; border-bottom: 1px solid rgba(0,0,0,.125);">
                    <img style="height: 100px;" src="{{url("ressources/logo-petit.png")}}">
                    <h2>Espace médecin</h2>
                </div>
                <form method="post" style="padding: 20px; border-bottom: 1px solid rgba(0,0,0,.125);" class="login-form" action="{!! url('doctor/setPasswordDoctor') !!}">
                    <div class="form-group">
                        <input type="password" name="newPassword" class="form-control"  placeholder="Mot de passe">
                        <div style="text-align: center; margin-top: 10px">
                            <button type="submit" class="btn btn-dark"><i class="fas fa-sign-in-alt"></i>  Valider</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8 banner-sec-doctor">
            </div>
        </div>
    </div>
@endsection