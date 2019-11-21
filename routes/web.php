<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['web']], function () {

    // COMMON ROUTE

    Route::get('/', function () {
        return view("start");
    });

    // PATIENT ROUTE

    Route::get('patient/fiches', 'patient\fichesController@getFiches');
    Route::post('patient/fiches', 'patient\fichesController@postFiches');


    Route::get('patient/fiches/{sicknessName}', 'patient\fichesController@getFicheBySicknessName');


    Route::get('patient/login', 'patient\usersController@getInfosLogin');
    Route::post('patient/login', 'patient\usersController@postInfosLogin');

    Route::get('patient/register', 'patient\usersController@getInfosRegister');
    Route::post('patient/register', 'patient\usersController@postInfosRegister');


    Route::get('patient/feeds/{page}', 'patient\feedsController@getFeeds');


    Route::get('patient/messaging', 'patient\chatController@getConversations');
    Route::get('patient/messaging/{conversationId}/homedoc', 'patient\chatController@getConversationById');
    Route::get('patient/messaging/{conversationId}', 'patient\chatController@getConversationByIdDoctor');
    Route::get('patient/doctorsList', 'patient\chatController@getDoctorsList');
    Route::get('patient/doctorProfil/{conversationId}', 'patient\chatController@getDoctorProfil');
    Route::get('patient/newConversation', 'patient\chatController@newConversation');
    Route::post('patient/createConversation', 'patient\ajaxController@createConversation');
    Route::post('patient/deleteConversation', 'patient\ajaxController@deleteConversation');
    Route::post('patient/listConversations', 'patient\ajaxController@listConversations');

    Route::get('patient/editProfil', 'patient\profilController@getEditProfil');
    Route::post('patient/editProfil', 'patient\profilController@postEditProfil');
    Route::get('patient/editPassword', 'patient\profilController@getEditPassword');
    Route::post('patient/editPassword', 'patient\profilController@postEditPassword');
    Route::get('patient/profil', 'patient\profilController@getProfil');

    // DOCTOR ROUTE

    Route::get('doctor/login', 'doctor\doctorsController@getInfosLogin');
    Route::post('doctor/login', 'doctor\doctorsController@postInfosLogin');
    Route::get('doctor/firstLogin', 'doctor\doctorsController@getInfosfirstLogin');
    Route::get('doctor/setPasswordDoctor', 'doctor\doctorsController@getPasswordDoctor');
    Route::post('doctor/firstLogin', 'doctor\doctorsController@validDoctor');
    Route::post('doctor/setPasswordDoctor', 'doctor\doctorsController@setPasswordDoctor');
    Route::get('doctor/register', 'doctor\doctorsController@getInfosRegister');
    Route::post('doctor/register', 'doctor\doctorsController@postInfosRegister');


    Route::get('doctor/home', 'doctor\doctorsController@getFeeds');

    Route::get('doctor/feeds/{feedId}', 'doctor\doctorsController@getFeedById');

    Route::get('doctor/profil', 'doctor\profilController@getProfil');
    Route::get('doctor/editProfil', 'doctor\profilController@getEditProfil');
    Route::post('doctor/editProfil', 'doctor\profilController@postEditProfil');
    Route::get('doctor/editPassword', 'doctor\profilController@getEditPassword');
    Route::post('doctor/editPassword', 'doctor\profilController@postEditPassword');
    Route::get('doctor/wiki', 'doctor\WikiController@getWiki');
    Route::get('doctor/wikicreate', 'doctor\WikiController@getWikiCreate');
    Route::post('doctor/wikicreate', 'doctor\WikiController@postWikiCreate');
    Route::get('doctor/editWiki', 'doctor\WikiController@getEditWiki');
    Route::post('doctor/editWiki', 'doctor\WikiController@postEditWiki');
    Route::post('doctor/sendEditWiki', 'doctor\WikiController@sendEditWiki');
    Route::get('doctor/wiki/{sicknessName}', 'doctor\WikiController@getFicheBySicknessName');
    Route::get('doctor/editWiki/{sicknessName}', 'doctor\WikiController@getFicheBySicknessName');
    Route::delete('doctor/wiki/{id}', 'doctor\WikiController@deleteFicheById');


    Route::get('doctor/messaging', 'doctor\chatController@getConversations');
    Route::get('doctor/messaging/{conversationId}/homedoc', 'doctor\chatController@getConversationById');
    Route::get('doctor/messaging/{conversationId}', 'doctor\chatController@getConversationByIdDoctor');
    Route::get('doctor/newConversation', 'doctor\chatController@newConversation');
    Route::post('doctor/createConversation', 'doctor\ajaxController@createConversation');
    Route::post('doctor/deleteConversation', 'doctor\ajaxController@deleteConversation');
    Route::post('doctor/listConversations', 'doctor\ajaxController@listConversations');
    Route::get('doctor/chatbot', function () {
        // Set session variables
        return view('doctor/chatbot');
    });

    //ADMIN ROUTE
    Route::get('admin/login', 'admin\adminController@getLogin');
    Route::post('admin/login', 'admin\adminController@postLogin');
    Route::get('admin/dashboard', 'admin\adminController@getDashboard');
    Route::get('admin/stats', 'admin\adminController@getStats');
    Route::get('admin/patient', 'admin\adminController@getPatient');
    Route::get('admin/doctorProfil/{doctorId}', 'admin\adminController@getDoctorProfil');
    Route::post('admin/doctorProfil', 'admin\adminController@postValid');

});
