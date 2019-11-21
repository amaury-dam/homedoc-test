<?php

namespace App\Http\Controllers\doctor;

use App\Common\curlRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class WikiController extends Controller
{
    private  $curlRequest;

    function __construct()
    {
        $this->curlRequest = new curlRequest();
    }

    public function getWiki(Request $request)
    {
        $body = [
            "token" => session()->get('token')
        ];
        $url = "http://51.38.234.54:8042/sickness/all";
            $response = $this->curlRequest->doGetRequest($url);
            $json = json_decode($response, true);

        return view('doctor/wiki')->with(array('sickness' => $json));
    }

    public function getWikiCreate()
    {
        $body = [
            "token" => session()->get('token')
        ];
        $url = "http://51.38.234.54:8042/sickness/all";
        $response = $this->curlRequest->doGetRequest($url);
        $json = json_decode($response, true);

        return view('doctor/wikicreate')->with(array('sickness' => $json));
    }

    public function postWikiCreate(Request $request)
    {
        $body = [
            "nom" => $request->input('nom'),
            "symptomes" => array_filter($request->input('symptomes')),
            "pronom" => $request->input('pronom'),
            "description" => $request->input('description')
        ];

        $response = $this->curlRequest->doPutRequest($body, "http://51.38.234.54:8042/sickness/");
        $json = json_decode($response, true);
        return redirect('doctor/wiki');
    }

    public function postFiches(Request $request)
    {

        $sicknessName = $request->input('sickness');
        /*   $url = "http://51.38.234.54:8042/sickness/?sickness_name=" . $sicknessName;
           $response = $this->curlRequest->doGetRequest($url);
           print_r($response);
           $json = json_decode($response, true);
           return redirect('patient/fiches/' . $sicknessName)->with(array('sickness' => $json));*/
        return redirect('doctor/editWiki/' . $sicknessName);
    }

    public function getEditWiki()
    {
        $body = [
            "token" => session()->get('token')
        ];
        $url = "http://51.38.234.54:8042/sickness/all";
        $response = $this->curlRequest->doGetRequest($url);
        $json = json_decode($response, true);

        return view('doctor/editWiki')->with(array('sickness' => $json));
    }

    public function postEditWiki(Request $request)
    {
        $sicknessName = $request->input('sickness');
        $url = "http://51.38.234.54:8042/sickness/?sickness_name=" . $sicknessName;
        $response = $this->curlRequest->doGetRequest($url);
        $json = json_decode($response, true);
        return view('doctor/editWiki')->with(array('sickness' => $json));
    }

    public function sendEditWiki(Request $request)
    {
        $body = [
            "nom" => $request->input('nom'),
            "id" => $request->input('id'),
            "symptomes" => $request->input('symptomes'),
            "pronom" => $request->input('pronom'),
            "description" => $request->input('description')
        ];
        $response = $this->curlRequest->doPostRequest($body, "http://51.38.234.54:8042/sickness/");
        $json = json_decode($response, true);
        return redirect('doctor/wiki');
    }

    public function deleteFicheById($id)
    {

        $url = "http://51.38.234.54:8042/sickness/?id=" . $id;
        $response = $this->curlRequest->doDelRequest($url);
        $json = json_decode($response, true);
        print_r($json);
        return view('doctor/wiki')->with(array('sickness' => $json));
    }

    public function getFicheBySicknessName($sicknessName) {

        $url = "http://51.38.234.54:8042/sickness/?sickness_name=" . $sicknessName;
        $response = $this->curlRequest->doGetRequest($url);
        $json = json_decode($response, true);
        return view('doctor/editWiki')->with(array('sickness' => $json));
    }

}
