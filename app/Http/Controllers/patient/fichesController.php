<?php
/**
 * Created by PhpStorm.
 * User: pierr
 * Date: 15/01/2019
 * Time: 08:46
 */

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Common\curlRequest;
use Illuminate\Http\Request;

class fichesController extends Controller
{
    private  $curlRequest;

    function __construct()
    {
        $this->curlRequest = new curlRequest();
    }

    public function getFiches()
    {
        $url = "http://51.38.234.54:8042/sickness/all";
        $response = $this->curlRequest->doGetRequest($url);
        $json = json_decode($response, true);
        return view('patient/fiches')->with(array('sickness' => $json));
    }

    public function postFiches(Request $request)
    {

        $sicknessName = $request->input('sickness');
     /*   $url = "http://51.38.234.54:8042/sickness/?sickness_name=" . $sicknessName;
        $response = $this->curlRequest->doGetRequest($url);
        print_r($response);
        $json = json_decode($response, true);
        return redirect('patient/fiches/' . $sicknessName)->with(array('sickness' => $json));*/
        return redirect('patient/fiches/' . str_replace(' ', '_', $sicknessName));
    }

    public function getFicheBySicknessName($sicknessName) {

        $url = "http://51.38.234.54:8042/sickness/?sickness_name=" . $sicknessName;
        $response = $this->curlRequest->doGetRequest($url);
        $json = json_decode($response, true);
        return view('patient/sicknessFiche')->with(array('sickness' => $json));
    }
}
