<?php

namespace App\Http\Controllers\admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\curlRequest;

class adminController extends Controller
{
    private  $curlRequest;

    function __construct()
    {
        $this->curlRequest = new curlRequest();
    }

    public function getLogin()
    {
        if (session()->exists("login_token")) {
            session()->remove("login_token");
        }
       return view('admin/login');
    }

    public function postLogin(Request $request)
    {
        $login =  $request->input('login');
        $password =   $request->input('password');

        $admin = Admin::where("password", md5($password))->where("login", $login)->first();

        if (isset($admin)) {
            session()->put('login_token', bin2hex(random_bytes(16)));
            return redirect('admin/dashboard');
        } else {
            session()->flash('error', 'Bad login or password');
            return redirect('admin/login');
        }
    }

    public function getDashboard() {
        if (session()->has('login_token')) {
            $response = $this->curlRequest->doGetRequest("https://api.homedoc.fr/doctorsList");
            $json = json_decode($response, true);
            return view('admin/dashboard')->with(['doctorsList' => $json['doctors']]);
        }
        else
            return redirect('admin/login');
    }

    public function getStats() {
        if (session()->has('login_token')) {
            $response = $this->curlRequest->doGetRequest("https://api.homedoc.fr/doctorsList");
            $json = json_decode($response, true);
            $responses = $this->curlRequest->doGetRequest("https://api.homedoc.fr/usersList");
            $jsons = json_decode($responses, true);
            return view('admin/stats')->with(['doctorsList' => $json['doctors'], 'userList' => $jsons['users']]);
        }
        else
            return redirect('admin/login');
    }

    function getDoctorProfil($profil) {
        $body = [
            "token" => session()->get('token')
        ];
        $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/getUser");
        $user = json_decode($response, true);

        $profil = $this->curlRequest->doGetRequest("https://api.homedoc.fr/getDoctor/" .$profil);
        $profil = json_decode($profil, true);
        return view('admin/doctorProfil')->with(array("profil" =>  $profil['doctorData']));
    }

    public function getPatient() {
        if (session()->has('login_token')) {
            $response = $this->curlRequest->doGetRequest("https://api.homedoc.fr/usersList");
            $json = json_decode($response, true);
            return view('admin/patient')->with(array('userList' => $json['users']));
        }
        else
            return redirect('admin/login');
    }

    public function postValid(Request $request)
    {
        $body = [
            "token" => session()->get('token'),
            "isValid" => $request->input('isValid'),
        ];
        $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/doctorList");
        $json = json_decode($response, true);
        if ($json['state'] == 'success') {
            /*$userData = array();
            $userData['firstname'] = $request->input('firstname');
            $userData['lastname'] = $request->input('lastname');
            $userData['dateOfBirth'] = $request->input('dateOfBirth');
            return redirect('profil')->with(array('userData' => $userData)); */
            return redirect('admin/dashboard');
        }

    }
}
