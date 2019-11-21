<?php

namespace App\Http\Controllers\patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\curlRequest;

class usersController extends Controller
{
    private  $curlRequest;

    function __construct()
    {
        $this->curlRequest = new curlRequest();
    }

    public function getInfosLogin()
    {
        if (session()->exists("token")) {
            $body = [
                "token" => session()->get('token')
            ];
            $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/logout");
            $json = json_decode($response, true);
            if ($json['state'] == 'success') {
                session()->remove("token");
            }
        }
        return view('patient/login');
    }

    public function postInfosLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.email' => 'Incorrect Email format',
            'password.min' => 'Password too short'
        ]);
        $body = [
            "email" => $request->input('email'),
            "password" => $request->input('password')
        ];
        $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/login");
        $json = json_decode($response, true);
        if ($json['state'] == 'success')
        {
            session()->put('token', $json['token']);
            return redirect('patient/feeds/0');
        }
        return redirect('patient/login');
    }

    public function getInfosRegister()
    {
        return view('patient/register');
    }

    public function postInfosRegister(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'dateOfBirth' => 'required'
        ], [
        ]);
        $body = [
            "email" => $request->input('email'),
            "password" => $request->input('password'),
            "firstname" => $request->input('firstname'),
            "lastname" => $request->input('lastname'),
            "dateOfBirth" => $request->input('dateOfBirth')
        ];
       $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/createUser");
       $json = json_decode($response, true);
       if ($json['state'] == 'success') {
           return redirect('patient/login');
       }
        return redirect('patient/login');
    }
}
