<?php
/**
 * Created by PhpStorm.
 * User: pierr
 * Date: 15/01/2019
 * Time: 08:46
 */

namespace App\Http\Controllers\doctor;

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

        $conversation = $this->curlRequest->doPostRequest($body, "https://messaging.homedoc.fr/conversation");
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
        $conversation = $this->curlRequest->doPostRequest($body, "https://messaging.homedoc.fr/conversation/all/doctor");
        $conversations = json_decode($conversation, true);
        $i = 0;
        $conversationsList = [];
        if (isset($conversations['lastMessages'])) {

            foreach ($conversations['lastMessages'] as $conversation) {
                if ($conversation['members'][0] == "000000000000000000000001") {
                    $conversationsList[$i]['member'] = "Home'Doc";
                } else {
                    $response = $this->curlRequest->doGetRequest("https://api.homedoc.fr/getUser/" . $conversation['members'][1]);
                    $member = json_decode($response, true);
                    $conversationsList[$i]['member'] = $member['userData']['lastname'] . " " . $member['userData']['firstname'];
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
