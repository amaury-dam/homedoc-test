@extends('patient/coreMenu')

@section('content')
    <div class="container">
        @if (session()->has('message'))
            <p style="text-align: center;" class="alert alert-danger">{{ session()->get('message') }}</p>

        @endif
            <div style="margin-top: 90px; text-align: center; box-shadow: 0 3px 6px rgba(0,0,0,.16),0 3px 6px rgba(0,0,0,.23); padding-bottom: 20px; background-color: white;">
                <div class="conversations-header">
                    <div style="float: left; width: 70%; height: 100%; display: flex; align-items: center; justify-content: left;">
                        <h2 class="private-messages">Edition de mot de passe</h2>
                    </div>
                </div>
                <form  method="POST" action="{!! url('patient/editPassword') !!}" style="padding-top: 10px; margin-left: 30px; margin-right: 30px;">
                    <div class="form-row">
                        <div class="form-group col-md-12" style="text-align: left; font-weight: bold;">
                            <label for="lastname">Ancien mot de passe</label>
                            <input type="password" name="oldPassword" class="form-control" placeholder="Ancien mot de passe">
                        </div>
                        <div class="form-group col-md-12" style="text-align: left; font-weight: bold;">
                            <label for="firstname">Nouveau mot de passe</label>
                            <input type="password" name="newPassword" class="form-control" placeholder="Nouveau mot de passe">
                        </div>
                        <div class="form-group col-md-12" style="text-align: left; font-weight: bold;">
                            <label for="firstname">Confirmation mot de passe</label>
                            <input type="password" name="confNewPassword" class="form-control" placeholder="Confirmation mot de passe">
                        </div>
                    </div>
                    <div style="text-align: center;">
                        <button type="submit" class="btn new-conversation" style="background-color: #4c934c; color: white; text-align: center;"><i class="far fa-edit"></i> Valider</button>
                    </div>

                </form>
            </div>
    </div>

@endsection