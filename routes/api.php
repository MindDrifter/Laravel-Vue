<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserCardsController;



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

Route::get('/user', function () {

    return response()->json('asdasd');
});

Route::get('/contact_messages', function (ContactController $contactController) {
    return $contactController->allData();
})->name('contact_messages');

Route::get('/contact_message_delete/{id}', [ContactController::class, 'deleteMessage']);
//Route::get('/contact_message_delete', [ContactController::class, 'deleteMessage']);

//Route::post('/user_cards/add_card/confirm', function (CreateCardRequest $createCardRequest, UserCardsController $userCardsController){
//    return $userCardsController->createCard($createCardRequest);
//})->name('add_card_confirm');

Route::post('/contact/submit', function (ContactController $contactController, Request $request){
    return $contactController->submit($request);
})->name('contact_submit');

Route::post('/register/success', function (AuthController $authController, AuthRequest $authRequest){
    return $authController->applyRegistration($authRequest);
})->name('register_confirm');

Route::post('/register/checkEmail', function (AuthController $authController, Request $authRequest){
    return $authController->checkEmail($authRequest);
});

Route::post('/login/success', function (AuthController $authController, Request $authRequest){
    return $authController->loginIn($authRequest);
});

Route::post('/user_cards', function (Request $request, UserCardsController $userCardsController){
    return $userCardsController->loadUserCards($request);
})->name('user_cards');

Route::post('/user_cards/add_card/confirm', function (Request $createCardRequest, UserCardsController $userCardsController){
    return $userCardsController->createCard($createCardRequest);
})->name('add_card_confirm');

Route::post('/user_cards/delete_card', function (Request $request, UserCardsController $userCardsController){
    return $userCardsController->deleteCard($request);
})->name('delete_card');

