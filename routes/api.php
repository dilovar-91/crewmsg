<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');
   
    
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');

});
Route::get('interview/{id}/questions', 'Sailor\InterviewController@getInterview');
Route::get('user/{id}/interviews', 'Sailor\InterviewController@getUserInterviews');
Route::get('seamen/interview/feedback/{id}/{user_id}', 'Seamen\FeedbackController@getFeedback');
Route::post('/seamen/interview/videosend', [
    'uses' => 'Seamen\InterviewController@videosend',
    'as' => 'seamen.interview.videosend'
]);
Route::post('/seamen/interview/invited', [
    'uses' => 'Seamen\InterviewController@invited',
    'as' => 'seamen.interview.invited'
]);

//employer routes
Route::get('interview/interviews', 'Employer\InterviewController@getInterviews');
Route::get('employer/interview/{id}', 'Employer\InterviewController@getInterview');
Route::post('interview/create', 'Employer\InterviewController@create');
Route::post('interview/update', 'Employer\InterviewController@update');
Route::get('employer/{id}/interviews', 'Employer\InterviewController@getInterviews');

Route::get('user/{id}/vacancies', 'Employer\VacancyController@vacancies');
Route::post('vacancy/create', 'Employer\VacancyController@create');
Route::post('vacancy/update', 'Employer\VacancyController@update');
Route::post('vacancy/uploadimage', 'Employer\VacancyController@imageUpload');


