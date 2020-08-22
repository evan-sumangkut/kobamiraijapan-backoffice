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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::patch('user_update','HomeController@user_update')->name('user.update');

Route::prefix('magang')->group(function () {
    Route::get('', 'MagangController@view')->name('magang');
    Route::get('create','MagangController@create')->name('magang.create');
    Route::get('edit/{id}','MagangController@edit')->name('magang.edit');
    Route::post('add','MagangController@add')->name('magang.add');
    Route::patch('update/{id}','MagangController@update')->name('magang.update');
    Route::patch('pembayaran','MagangController@pembayaran')->name('magang.pembayaran');
    Route::delete('delete','MagangController@delete')->name('magang.delete');
});

Route::prefix('persona')->group(function () {
    Route::get('', 'PersonaController@view')->name('persona');
    Route::post('add','PersonaController@add')->name('persona.add');
    Route::patch('update','PersonaController@update')->name('persona.update');
    Route::delete('delete','PersonaController@delete')->name('persona.delete');
});

// Route::prefix('users')->group(function () {
//     Route::get('', 'UserController@view')->name('user');
//     Route::post('add','UserController@add')->name('user.add');
//     Route::patch('update','UserController@update')->name('user.update');
//     Route::patch('password','UserController@password')->name('user.password');
//     Route::delete('delete','UserController@delete')->name('user.delete');
// });

Route::prefix('tag')->group(function () {
    Route::get('', 'TagController@view')->name('tag');
    Route::get('look/{id}', 'TagController@look')->name('tag.look');
    Route::post('add','TagController@add')->name('tag.add');
    Route::patch('update','TagController@update')->name('tag.update');
    Route::delete('delete','TagController@delete')->name('tag.delete');
});

Route::prefix('question')->group(function () {
    Route::get('', 'QuestionController@view')->name('question');
    Route::get('create','QuestionController@create')->name('question.create');
    Route::post('add','QuestionController@add')->name('question.add');
    Route::patch('update','QuestionController@update')->name('question.update');
    Route::delete('delete','QuestionController@delete')->name('question.delete');
});

Route::prefix('category')->group(function () {
    Route::get('', 'CategoryController@view')->name('category');
    Route::post('add','CategoryController@add')->name('category.add');
    Route::patch('update','CategoryController@update')->name('category.update');
    Route::delete('delete','CategoryController@delete')->name('category.delete');
});

Route::prefix('form')->group(function () {
    Route::get('', 'FormController@view')->name('form');
    Route::post('add','FormController@add')->name('form.add');
    Route::patch('update','FormController@update')->name('form.update');
    Route::delete('delete','FormController@delete')->name('form.delete');
    Route::prefix('manage')->group(function () {
        Route::get('of/{id}', 'FormController@view_question')->name('form.question');
        Route::get('create/{id}','FormController@create_question')->name('form.question.create');
        Route::post('add/{id}','FormController@add_question')->name('form.question.add');
        Route::patch('update','FormController@update_question')->name('form.question.update');
        Route::delete('delete','FormController@delete_question')->name('form.question.delete');
    });
});

// Route::prefix('scenario')->group(function () {
//     Route::get('', 'ScenarioController@view')->name('scenario');
//     Route::post('add','ScenarioController@add')->name('scenario.add');
//     Route::patch('update','ScenarioController@update')->name('scenario.update');
//     Route::delete('delete','ScenarioController@delete')->name('scenario.delete');
//     Route::prefix('weight')->group(function () {
//         Route::get('of/{id}', 'ScenarioController@view_weight')->name('scenario.weight');
//         Route::patch('update','ScenarioController@update_weight')->name('scenario.weight.update');
//     });
//     Route::prefix('schedule')->group(function () {
//         Route::get('of/{id}', 'ScenarioController@view_schedule')->name('scenario.schedule');
//         Route::patch('update','ScenarioController@update_schedule')->name('scenario.schedule.update');
//     });
// });

Route::prefix('scenario')->group(function () {
    Route::get('', 'SurveyController@view')->name('scenario');
    Route::prefix('survey')->group(function () {
        Route::get('of/{id}', 'SurveyController@survey')->name('survey');
        Route::post('add','SurveyController@add')->name('survey.add');
        Route::patch('update','SurveyController@update')->name('survey.update');
        Route::delete('delete','SurveyController@delete')->name('survey.delete');
        Route::patch('opening','SurveyController@opening')->name('survey.opening');
        Route::patch('active','SurveyController@active')->name('survey.active');
        Route::prefix('form')->group(function () {
            Route::get('of/{id}', 'SurveyController@view_form')->name('survey.form');
            Route::get('create/{id}','SurveyController@create_form')->name('survey.form.create');
            Route::post('add/{id}','SurveyController@add_form')->name('survey.form.add');
            Route::patch('update','SurveyController@update_form')->name('survey.form.update');
            Route::delete('delete','SurveyController@delete_form')->name('survey.form.delete');
            Route::get('question/{id}','SurveyController@form_question')->name('survey.form.question');
            Route::post('question/add/{id}','SurveyController@form_question_add')->name('survey.form.question.add');
            Route::get('confirmation/{id}','SurveyController@form_confirmation')->name('survey.form.confirmation');
            Route::get('confirmation/create/{id}','SurveyController@form_confirmation_create')->name('survey.form.confirmation.create');
            Route::post('confirmation/add/validation','SurveyController@form_confirmation_add')->name('survey.form.confirmation.add');
            Route::delete('confirmation/delete/validation','SurveyController@form_confirmation_delete')->name('survey.form.confirmation.delete');
        });
        Route::prefix('responden')->group(function () {
            Route::get('of/{id}', 'SurveyController@view_responden')->name('survey.responden');
            Route::post('add/{id}','SurveyController@add_responden')->name('survey.responden.add');
            Route::patch('update','SurveyController@update_responden')->name('survey.responden.update');
            Route::delete('delete','SurveyController@delete_responden')->name('survey.responden.delete');
        });
        Route::prefix('cronjob')->group(function () {
            Route::get('of/{id}', 'SurveyController@view_cronjob')->name('survey.cronjob');
            Route::post('add/{id}','SurveyController@add_cronjob')->name('survey.cronjob.add');
            Route::patch('update','SurveyController@update_cronjob')->name('survey.cronjob.update');
            Route::delete('delete','SurveyController@delete_cronjob')->name('survey.cronjob.delete');
        });
        Route::prefix('chatbot')->group(function () {
            Route::get('of/{id}', 'SurveyController@view_chatbot')->name('survey.chatbot');
        });
        Route::prefix('recapitulation')->group(function () {
            Route::get('of/{id}', 'SurveyController@view_recapitulation')->name('survey.recapitulation');
            Route::get('responden/{id}', 'SurveyController@responden_recapitulation')->name('survey.recapitulation.responden');
            Route::get('look/{id}', 'SurveyController@look_recapitulation')->name('survey.recapitulation.look');
            Route::delete('delete','SurveyController@delete_recapitulation')->name('survey.recapitulation.delete');
        });
        Route::prefix('greeting')->group(function () {
            Route::get('of/{id}', 'SurveyController@view_greeting')->name('survey.greeting');
            Route::patch('update','SurveyController@update_greeting')->name('survey.greeting.update');
        });
    });
    Route::prefix('persona_builder')->group(function () {
        Route::get('', 'PersonaBuilderController@view')->name('persona.builder');
        Route::get('of/{id}', 'PersonaBuilderController@open')->name('persona.builder.open');
        Route::post('create', 'PersonaBuilderController@create')->name('persona.builder.create');
        Route::post('add', 'PersonaBuilderController@add')->name('persona.builder.add');
        Route::patch('update', 'PersonaBuilderController@update')->name('persona.builder.update');
        Route::delete('delete', 'PersonaBuilderController@delete')->name('persona.builder.delete');
        Route::get('chatbot/{id}', 'PersonaBuilderController@chatbot')->name('persona.builder.chatbot');
    });
    Route::prefix('greeting')->group(function () {
        Route::get('of/{id}', 'ScenarioGreetingController@view')->name('scenario.greeting');
        Route::get('edit/{id}', 'ScenarioGreetingController@edit')->name('scenario.greeting.edit');
        Route::patch('update/{id}','ScenarioGreetingController@update')->name('scenario.greeting.update');
        Route::post('add/{id}','ScenarioGreetingController@add')->name('scenario.greeting.add');
        Route::delete('delete', 'ScenarioGreetingController@delete')->name('scenario.greeting.delete');
        Route::patch('information/update','ScenarioGreetingController@information_update')->name('scenario.greeting.information_update');
    });
});



Route::prefix('responden')->group(function () {
    Route::get('', 'RespondenController@view')->name('responden');
    Route::post('add','RespondenController@add')->name('responden.add');
    Route::patch('update','RespondenController@update')->name('responden.update');
    Route::delete('delete','RespondenController@delete')->name('responden.delete');
});

Route::get('logger', 'LoggerController@view')->name('logger');
