<?php

namespace App\Http\Controllers\doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\curlRequest;
use App\Common\feedsRSS;


class doctorsController extends Controller
{
    private  $curlRequest;
    private  $feeds;

    function __construct()
    {
        $this->curlRequest = new curlRequest();
        $this->feeds = new feedsRSS();
    }

    function getFeeds()
    {
        $feed = $this->feeds->make('https://medium.com/feed/homedoc', true);
        $data = array(
            'title' => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items' => $feed->get_items(),
        );
        return view('doctor/feeds')->with($data);
    }

    function getFeedById($feedId)
    {
        $feed = $this->feeds->make('https://medium.com/feed/homedoc', true);

        $item = $feed->get_item($feedId);
        return view('doctor/home')->with(array('item' => $item));

        echo $feedId;
    }

    public function getInfosLogin()
    {
        if (session()->exists("token")) {
            $body = [
                "token" => session()->get('token')
            ];
            $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/logoutDoctor");
            $json = json_decode($response, true);
            if ($json['state'] == 'success') {
                session()->remove("token");
            }
        }
        return view('doctor/login');
    }

    public function validDoctor(Request $request)
    {

            $body = [
                "email" => $request->input('email'),
                "accessCode" => $request->input('accessCode'),
            ];
            $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/validDoctor");
            $json = json_decode($response, true);
            if ($json['state'] == 'success') {
                session()->put('doctorId', $json['doctorId']);
                return redirect('doctor/setPasswordDoctor');
            }
        return view('doctor/login');
    }

    public function getPasswordDoctor(Request $request)
    {
        return view('doctor/setPasswordDoctor');
    }

    public function setPasswordDoctor(Request $request)
    {
        if (session()->exists("doctorId")) {
            $body = [
                "doctorId" => session()->get('doctorId'),
                "password" => $request->input('newPassword')
            ];
            $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/setPasswordDoctor");
            $json = json_decode($response, true);
            if ($json['state'] == 'success') {
                session()->remove("doctorId");
            }
        }
        return view('doctor/login');
    }

    public function getInfosFirstLogin()
    {
        if (session()->exists("token")) {
            $body = [
                "token" => session()->get('token')
            ];
            $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/logoutDoctor");
            $json = json_decode($response, true);
            if ($json['state'] == 'success') {
                session()->remove("token");
            }
        }
        return view('doctor/firstLogin');
    }

    public function postInfosLogin(Request $request)
    {
        /*    $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|min:3'
            ], [
                'email.email' => 'Incorrect Email format',
                'password.min' => 'Password too short'
            ]);*/
        $body = [
            "email" => $request->input('email'),
            "password" => $request->input('password')
        ];
        $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/loginDoctor");
        $json = json_decode($response, true);
        if ($json['state'] == 'success')
        {
            session()->put('token', $json['token']);
            return redirect('doctor/home');
        }
        return redirect('doctor/login')->withErrors(array('msg' => 'Wrong'));
    }

    public function getInfosRegister()
    {
        $speciality = array("ACUPUNCTURE","ADDICTOLOGIE / TOXICOMANIES ET ALCOOLOGIE","AIDE MEDICALE URGENTE OU MEDECINE D'URGENCE","ALLERGOLOGIE","ANATOMIE ET CYTOLOGIE PATHOLOGIQUES","ANDROLOGIE","ANESTHESIE-REANIMATION","ANGEIOLOGIE / MEDECINE VASCULAIRE","BIOCHIMIE HORMONALE ET METABOLIQUE","BIOLOGIE DES AGENTS INFECTIEUX","BIOLOGIE MEDICALE","BIOLOGIE MEDICALE OPTION BIOLOGIE DE LA REPRODUCTION","BIOLOGIE MEDICALE OPTION BIOLOGIE GENERALE","BIOLOGIE MEDICALE OPTION HEMATOLOGIE ET IMMUNOLOGIE","BIOLOGIE MEDICALE OPTION MEDECINE MOLECULAIRE, GENETIQUE ET PHARMACOLOGIE","BIOLOGIE MOLECULAIRE","CANCEROLOGIE","CANCEROLOGIE OPTION BIOLOGIE EN CANCEROLOGIE","CANCEROLOGIE OPTION CHIRURGIE CANCEROLOGIQUE","CANCEROLOGIE OPTION IMAGERIE EN CANCEROLOGIE","CANCEROLOGIE OPTION RESEAUX DE CANCEROLOGIE","CANCEROLOGIE OPTION TRAITEMENTS MEDICAUX DES CANCERS","CARDIOLOGIE ET MALADIES VASCULAIRES","CHIRURGIE DE LA FACE ET DU COU","CHIRURGIE GENERALE","CHIRURGIE INFANTILE","CHIRURGIE MAXILLO-FACIALE (REFORME 2017)","CHIRURGIE MAXILLO-FACIALE ET STOMATOLOGIE","CHIRURGIE ORALE","CHIRURGIE ORTHOPEDIQUE ET TRAUMATOLOGIQUE","CHIRURGIE PEDIATRIQUE OPTION CHIRURGIE VISCERALE PEDIATRIQUE","CHIRURGIE PEDIATRIQUE OPTION ORTHOPEDIE PEDIATRIQUE","CHIRURGIE PLASTIQUE, RECONSTRUCTRICE ET ESTHETIQUE","CHIRURGIE THORACIQUE ET CARDIO-VASCULAIRE","CHIRURGIE UROLOGIQUE","CHIRURGIE VASCULAIRE","CHIRURGIE VISCERALE ET DIGESTIVE","CYTOGENETIQUE HUMAINE","DERMATOLOGIE ET VENEREOLOGIE","DERMATOPATHOLOGIE","ENDOCRINOLOGIE ET METABOLISMES","ENDOCRINOLOGIE-DIABETOLOGIE-NUTRITION","EVALUATION ET TRAITEMENT DE LA DOULEUR","FOETOPATHOLOGIE","GASTRO-ENTEROLOGIE ET HEPATOLOGIE","GENETIQUE MEDICALE","GERIATRIE / GERONTOLOGIE","GYNECOLOGIE MEDICALE","GYNECOLOGIE MEDICALE ET OBSTETRIQUE","GYNECOLOGIE-OBSTETRIQUE / OBSTETRIQUE","HEMATOLOGIE","HEMATOLOGIE (REFORME 2017)","HEMATOLOGIE BIOLOGIQUE","HEMATOLOGIE OPTION MALADIES DU SANG","HEMATOLOGIE OPTION ONCO-HEMATOLOGIE","HEMOBIOLOGIE-TRANSFUSION / TECHNOLOGIE TRANSFUSIONNELLE","HEPATO-GASTRO-ENTEROLOGIE","HYDROLOGIE ET CLIMATOLOGIE MEDICALE","IMMUNOLOGIE ET IMMUNOPATHOLOGIE","MALADIES INFECTIEUSES ET TROPICALES","MEDECINE AEROSPATIALE","MEDECINE CARDIOVASCULAIRE","MEDECINE D'URGENCE","MEDECINE DE CATASTROPHE","MEDECINE DE LA DOULEUR ET MEDECINE PALLIATIVE","MEDECINE DE LA DOULEUR ET MEDECINE PALLIATIVE (OPTION MEDECINE DE LA DOULEUR ET OPTION MEDECINE PALLIATIVE)","MEDECINE DE LA REPRODUCTION","MEDECINE DE LA REPRODUCTION & GYNECOLOGIE MEDICALE","MEDECINE DU SPORT","MEDECINE DU TRAVAIL","MEDECINE ET SANTE AU TRAVAIL","MEDECINE GENERALE","MEDECINE INTENSIVE-REANIMATION","MEDECINE INTERNE","MEDECINE INTERNE ET IMMUNOLOGIE CLINIQUE","MEDECINE LEGALE ET EXPERTISES MEDICALES","MEDECINE NUCLEAIRE","MEDECINE PENITENTIAIRE","MEDECINE PHYSIQUE ET DE READAPTATION","MEDECINE VASCULAIRE","NEONATOLOGIE","NEONATOLOGIE (arrêté du 19.10.2001)","NEPHROLOGIE","NEUROCHIRURGIE","NEUROLOGIE","NEUROLOGIE ET PSYCHIATRIE","NEUROPATHOLOGIE","NEUROPATHOLOGIE (arrêté du 24.04.2002)","NUTRITION","ONCOLOGIE OPTION MEDICALE","ONCOLOGIE OPTION ONCO-HEMATOLOGIE","ONCOLOGIE OPTION ONCOLOGIE MEDICALE","ONCOLOGIE OPTION ONCOLOGIE RADIOTHERAPIE","ONCOLOGIE OPTION RADIOTHERAPIE","OPHTALMOLOGIE","ORL et CHIRUGIE CERVICO-FACIALE","ORTHOPEDIE DENTO-MAXILLO-FACIALE","OTO-RHINO-LARYNGOLOGIE","PATHOLOGIE INFECTIEUSE ET TROPICALE, CLINIQUE ET BIOLOGIQUE","PEDIATRIE","PHARMACOCINETIQUE ET METABOLISME DES MEDICAMENTS","PHARMACOLOGIE CLINIQUE ET EVAL.DES THERAPEUTIQUES","PHONIATRIE","PNEUMOLOGIE","PRATIQUES MEDICO JUDICIAIRES","PSYCHIATRIE","PSYCHIATRIE DE L'ENFANT ET DE L'ADOLESCENT","RADIO-DIAGNOSTIC ET IMAGERIE MEDICALE","RADIO-DIAGNOSTIQUE ET RADIO-THERAPIE","RADIOLOGIE ET IMAGERIE MEDICALE","RADIOPHARMACIE ET RADIOBIOLOGIE","REANIMATION","REANIMATION MEDICALE","RECHERCHE MEDICALE","RHUMATOLOGIE","SANTE PUBLIQUE","SANTE PUBLIQUE ET MEDECINE SOCIALE","STOMATOLOGIE","TOXICOLOGIE BIOLOGIQUE","UROLOGIE");
        return view('doctor/register')->with(['speciality' => $speciality]);
    }

    public function postInfosRegister(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email'
        ], [
            'email.email' => 'Incorrect Email format'
        ]);
        $body = [
            "email" => $request->input('email'),
            "password" => $request->input('password'),
            "firstname" => $request->input('firstname'),
            "lastname" => $request->input('lastname')
        ];
        $response = $this->curlRequest->doPostRequest($body, "https://api.homedoc.fr/createDoctor");
        $json = json_decode($response, true);
        if ($json['state'] == 'success') {
            return redirect('doctor/login');
        }
    }
}
