<?php

use Illuminate\Support\Facades\Route;;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\FileUpload\InputFile;
use App\Http\Controllers\TelegramController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('t/getupdates', function() {
    $updates = Telegram::getUpdates();
    return (json_encode($updates));
});

Route::post('t/sendmessage', function() {
    Telegram::sendMessage([
        'chat_id' => '987613379',
        'text' => 'Askida günaydıııııın mesajı'
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Mesaj başarıyla gönderildi'
    ]);
});

Route::post('t/sendimage', function() {
    Telegram::sendPhoto([
        'chat_id' => '987613379',
        'photo' => InputFile::create('C:\Users\hudan\Downloads\sad.jpeg'),
        'caption' => 'Bu şekil güne başladık'
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Mesaj başarıyla gönderildi'
    ]);
});

