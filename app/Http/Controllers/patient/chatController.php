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
use App\Common\feedsRSS;
use Illuminate\Http\Request;


class chatController extends Controller
{
    private  $curlRequest;

    function __construct()
    {
        $this->curlRequest = new curlRequest();
    }

    function newConversation() {
        return view('patient/conversationNew');
    }

    function getConversations() {
        $body = [
            "token" => session()->get('token')
        ];
        // all/doctor
        $response = $this->curlRequest->doPostRequest($body, "http://51.38.234.54:8082/conversation/all/user");
        $conversations = json_decode($response, true);
        $i = 0;
        $conversationsList = [];
        if (isset($conversations['lastMessages'])) {
            foreach ($conversations['lastMessages'] as $conversation) {
                if ($conversation['members'][0] == "000000000000000000000001") {
                    $conversationsList[$i]['member'] = "Home'Doc";
                } else {
                    $response = $this->curlRequest->doGetRequest("https://api.homedoc.fr/getDoctor/" . $conversation['members'][0]);
                    $member = json_decode($response, true);
                    $conversationsList[$i]['member'] = $member['doctorData']['lastname'] . " " . $member['doctorData']['firstname'];
                }
                if (isset($conversation['conversation']['messages'][0]['type'])) {
                    if ($conversation['conversation']['messages'][0]['type'] == "text") {
                        $conversationsList[$i]['text'] = $conversation['conversation']['messages'][0]['text'];
                    } else {
                        if (isset($conversation['conversation']['messages'][0]['text']['richResponse']['items'][0]['simpleResponse']['displayText']))
                            $conversationsList[$i]['text'] = $conversation['conversation']['messages'][0]['text']['richResponse']['items'][0]['simpleResponse']['displayText'];
                        else
                            $conversationsList[$i]['text'] = "Pièce jointe : 1 image";
                    }
                } else {
                    $conversationsList[$i]['text'] = null;
                }
                if (isset($conversation['conversation']['messages'][0]['date']))
                    $conversationsList[$i]['date'] = $conversation['conversation']['messages'][0]['date'];
                else
                    $conversationsList[$i]['date'] = null;
                $conversationsList[$i]['uid'] = $conversation['conversation']['uid'];
                $conversationsList[$i]['unread'] = $conversation['conversation']['unread'];
                $i++;
            }
            usort($conversationsList, function ($a, $b) {
                $v1 = strtotime($a['date']);
                $v2 = strtotime($b['date']);
                return $v2 <=> $v1;
            });
        }
        return view('patient/conversationList')->with(array('conversationsList' => $conversationsList));


    }

    function getConversationById($conversationId) {
        $body = [
            "token" => session()->get('token')
        ];
        $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/getUser");
        $user = json_decode($response, true);
        return view('patient/conversation')->with(array('conversationId' => $conversationId, 'memberId' => $user['userData']['_id']));

    }

    function getConversationByIdDoctor($conversationId) {
        $body = [
            "token" => session()->get('token')
        ];
        $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/getUser");
        $user = json_decode($response, true);
        $conversation = $this->curlRequest->doGetRequest("https://messaging.homedoc.fr/conversation/" . $conversationId);
        $conversation = json_decode($conversation, true);
        $profil = $this->curlRequest->doGetRequest("https://api.homedoc.fr/getDoctor/" . $conversation['members'][0]);
        $profil = json_decode($profil, true);
        return view('patient/conversationDoctor')->with(array('conversationId' => $conversationId, "memberId" => $user['userData']['_id'], "profil" => array("firstname" => $profil['doctorData']['firstname'], "lastname" => $profil['doctorData']['lastname'])));
    }

    function getDoctorProfil($profil) {
        $body = [
            "token" => session()->get('token')
        ];
        $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/getUser");
        $user = json_decode($response, true);

        $profil = $this->curlRequest->doGetRequest("https://api.homedoc.fr/getDoctor/" .$profil);
        $profil = json_decode($profil, true);
        return view('patient/doctorProfil')->with(array("profil" =>  $profil['doctorData']));
    }

    function getDoctorsList() {
        $doctors = $this->curlRequest->doGetRequest("https://api.homedoc.fr/getConnectedDoctors");
        $doctors = json_decode($doctors, true);
        $i = 0;
        $doctorsList = array();
        foreach ($doctors['connected'] as $doctor) {
            $doctorsList[$i]['firstname']  = $doctor['firstname'];
            $doctorsList[$i]['lastname']  = $doctor['lastname'];
            $doctorsList[$i]['_id']  = $doctor['_id'];
            $i++;
        }
        return view('patient/doctorsList')->with(array("doctorsList" => $doctorsList));
    }
}
