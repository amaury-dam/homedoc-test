<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Common\curlRequest;
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
        return view('patient/editPassword');
    }

    public function postEditPassword(Request $request)
    {
        if (strcmp($request->input('confNewPassword'), $request->input('newPassword')) != 0) {
            session()->flash('message', 'Confirmation de mot passe incorrect');
            return  view('patient/editPassword');
        } else {
            $body = [
                "token" => session()->get('token'),
                "oldPassword" => $request->input('oldPassword'),
                "newPassword" => $request->input('newPassword'),
            ];
            $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/changePassword");
            $json = json_decode($response, true);
            if ($json['state'] == 'success') {

                /* $userData = array();
                 $userData['firstname'] = $request->input('firstname');
                 $userData['lastname'] = $request->input('lastname');
                 $userData['dateOfBirth'] = $request->input('dateOfBirth');
                 return redirect('profil')->with(array('userData' => $userData));*/
                session()->flash('message', 'Changement de mot passe éffectué');
                return redirect('patient/profil');
            }
        }
    }

    public function getProfil()
    {
        $body = [
            "token" => session()->get('token')
        ];
        $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/getUser");
        $json = json_decode($response, true);
        if ($json['state'] == 'success')
        {
            return view('patient/profil')->with(array('userData' => $json['userData']));
        }
    }

    public function getEditProfil()
    {
        $body = [
            "token" => session()->get('token')
        ];
        $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/getUser");
        $json = json_decode($response, true);
        if ($json['state'] == 'success')
        {
            return view('patient/editProfil')->with(array('userData' => $json['userData']));
        }
        else
            return redirect('patient/login')->withErrors(array('msg' => 'Wrong'));
    }

    public function postEditProfil(Request $request)
    {

        $body = [
            "token" => session()->get('token'),
            "firstname" => $request->input('firstname'),
            "lastname" => $request->input('lastname'),
            "dateOfBirth" => $request->input('dateOfBirth'),
            "email" => $request->input('email'),
            "gender" => $request->input('gender'),
            "height" => $request->input('height'),
            "weight" => $request->input('weight'),
            "allergies" => array_filter($request->input('allergies')),
            "medicalHistory" => array_filter($request->input('medicalHistory')),
            "city" => $request->input('city')
        ];
        $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/editUser");
        $json = json_decode($response, true);
        if ($json['state'] == 'success') {
            /*$userData = array();
            $userData['firstname'] = $request->input('firstname');
            $userData['lastname'] = $request->input('lastname');
            $userData['dateOfBirth'] = $request->input('dateOfBirth');
            return redirect('profil')->with(array('userData' => $userData)); */
            return redirect('patient/profil');
        }

    }
}
