@extends('doctor/core')

@section('body')
    <div class="container login-box">
        <div class="row">
            <div class="col-md-4 login-sec">
                <div style="text-align: center; padding: 20px; border-bottom: 1px solid rgba(0,0,0,.125);">
                    <img style="height: 100px;" src="{{url("ressources/logo-petit.png")}}">
                    <h2>Espace médecin</h2>
                </div>
                <form method="post" style="padding: 20px; border-bottom: 1px solid rgba(0,0,0,.125);" class="login-form" action="{!! url('doctor/firstLogin') !!}">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control"  placeholder="Email">
                        <input type="text" name="accessCode" class="form-control" style="margin-top: 10px" placeholder="Code d'accès">
                        <div style="text-align: center; margin-top: 10px">
                            <button type="submit" class="btn btn-dark"><i class="fas fa-sign-in-alt"></i>  Valider</button>
                        </div>
                    </div>
                </form>
                <div style="text-align: center;">
                    <label for="speciality" style="font-weight: lighter;">Vous n'avez pas d'accès médecin?</label>
                    <a class="btn btn-dark"  href="{{ url('doctor/register') }}"  style="margin-top: 15px;" ><i class="fas fa-edit"></i>Obtenir un accès médecin</a>
                </div>
            </div>
            <div class="col-md-8 banner-sec-doctor">
            </div>
        </div>
    </div>
@endsection