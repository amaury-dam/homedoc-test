<?php

namespace App\Http\Controllers\doctor;

use App\Common\curlRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class profilController extends Controller
{
    private  $curlRequest;

    function __construct()
    {
        $this->curlRequest = new curlRequest();
    }


    public function getEditPassword()
    {
        return view('doctor/editPassword');
    }

    public function postEditPassword(Request $request)
    {
        if (strcmp($request->input('confNewPassword'), $request->input('newPassword')) != 0) {
            session()->flash('message', 'Confirmation de mot passe incorrect');
            return  view('doctor/editPassword');
        } else {
            $body = [
                "token" => session()->get('token'),
                "oldPassword" => $request->input('oldPassword'),
                "newPassword" => $request->input('newPassword'),
            ];
            $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/changePasswordDoctor");
            $json = json_decode($response, true);
            if ($json['state'] == 'success') {

                /* $userData = array();
                 $userData['firstname'] = $request->input('firstname');
                 $userData['lastname'] = $request->input('lastname');
                 $userData['dateOfBirth'] = $request->input('dateOfBirth');
                 return redirect('profil')->with(array('userData' => $userData));*/
                session()->flash('message', 'Changement de mot passe éffectué');
                return redirect('doctor/profil');
            }
        }
    }

    public function getProfil()
{
    $body = [
        "token" => session()->get('token')
    ];
    $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/getDoctor");
    $json = json_decode($response, true);
    if ($json['state'] == 'success')
    {
        return view('doctor/profil')->with(array('userData' => $json['doctorData']));
    }
}

    public function getEditProfil()
    {
        $body = [
            "token" => session()->get('token')
        ];
        $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/getDoctor");
        $json = json_decode($response, true);
        if ($json['state'] == 'success')
        {
            return view('doctor/editProfil')->with(array('userData' => $json['doctorData']));
        }
        else
            return redirect('doctor/login')->withErrors(array('msg' => 'Wrong'));
    }

    public function postEditProfil(Request $request)
    {
        $body = [
            "token" => session()->get('token'),
            "firstname" => $request->input('firstname'),
            "lastname" => $request->input('lastname'),
            "dateOfBirth" => $request->input('dateOfBirth'),
            "city" => $request->input('city')
        ];
        $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/editDoctor");
        $json = json_decode($response, true);
        if ($json['state'] == 'success') {
            /*$userData = array();
            $userData['firstname'] = $request->input('firstname');
            $userData['lastname'] = $request->input('lastname');
            $userData['dateOfBirth'] = $request->input('dateOfBirth');
            return redirect('profil')->with(array('userData' => $userData)); */
            return redirect('doctor/profil');
        }

    }
}
