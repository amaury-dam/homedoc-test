<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    @include('admin/header')

</head>
    <body class="login-block-admin">
        <div class="container login-box">
            <div class="row">
                <div class="col-md-4 login-sec">
                    <div style="text-align: center; padding: 20px; border-bottom: 1px solid rgba(0,0,0,.125);">
                        <img style="height: 100px;" src="{{url("/ressources/logo-petit.png")}}">
                        <h2>Espace Admin</h2>
                        @if (session()->has('error'))

                            <div class="alert alert-danger" style="font-size: 12px;">
                                Indentifiant Invalide
                            </div>

                        @endif
                    </div>
                    <form method="post" style="padding: 20px;" class="login-form" action="{!! url('admin/login') !!}">
                        <div class="form-group">
                            <input type="text" name="login" class="form-control" placeholder="Login">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Mot de passe">
                        </div>
                        <div style="text-align: center;">
                            <button type="submit" class="btn btn-dark"><i class="fas fa-sign-in-alt"></i> Connexion</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-8 banner-sec-patient">
                </div>
            </div>
        </div>
</body>
</html>
