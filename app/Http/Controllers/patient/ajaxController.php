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


class ajaxController extends Controller
{
    private  $curlRequest;

    function __construct()
    {
        $this->curlRequest = new curlRequest();
    }

    function generateRandomUid($length = 32) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function createConversation(Request $request) {
        date_default_timezone_set('Europe/Paris');
        $uid = $this->generateRandomUid();
        $body = [
            "token" => session()->get('token')
        ];
        $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/getUser");
        $json = json_decode($response, true);
        if (strcmp($request->type, "homedoc") === 0) {
            $body = [
                "members" => ["000000000000000000000001", $json['userData']['_id']],
                "conversation" => array("uid" => $uid),
                "token" => session()->get('token')
            ];
        } else {
            $body = [
                "members" => [$request->doctor_id , $json['userData']['_id']],
                "conversation" => array("uid" => $uid),
                "token" => session()->get('token')
            ];
        }

        $this->curlRequest->doPostRequest($body, "https://messaging.homedoc.fr/conversation");
        $symptoms = $this->curlRequest->doGetRequest("http://51.38.234.54:8042/patient-summary/?sessionId=projects/home-doc/agent/sessions/" . $request->uid);
        $json_symptoms = json_decode($symptoms, true);
        if (count($json_symptoms) != 0) {
            $message = "Bonjour, je suis un utilisateur. Voici la liste de mes symptomes : ";
            for ($i = 0; $i < count($json_symptoms); $i++) {
                if ($i + 1 < count($json_symptoms))
                    $message .= $json_symptoms[$i] . ', ';
                else
                    $message .= $json_symptoms[$i];
            }
            $body = [
                "uid" => $uid,
                "message" => [
                    "type" => "text",
                    "member" => $json['userData']['_id'],
                    "text" => $message,
                    "date" => date('Y-m-d H:i:s')
                ]
            ];
            $this->curlRequest->doPostRequest($body, "https://messaging.homedoc.fr/message");
            // uid: uid, message: {type: "text", member: member, text: val, date: dformat}
        }
        $response = array(
            'uid' => $uid
        );

        return response()->json($response);
    }

    function deleteConversation(Request $request) {
        $body = [
            "uid" => $request->uid,
            "token" => session()->get('token')
        ];

        $conversation = $this->curlRequest->doDeleteRequest($body, "https://messaging.homedoc.fr/conversation");

        $response = array(
            'state' => $request->uid
        );
        return response()->json($response);
    }

    function listConversations(Request $request) {
        $body = [
            "token" => session()->get('token')
        ];
        $conversation = $this->curlRequest->doPostRequest($body, "https://messaging.homedoc.fr/conversation/all/user");
        $conversations = json_decode($conversation, true);
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
        return response()->json($conversationsList);
    }
}
