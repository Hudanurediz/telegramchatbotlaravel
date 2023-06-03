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
        'chat_id' => '',//userchatid
        'text' => 'Askıda günaydın mesajı'
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Mesaj başarıyla gönderildi'
    ]);
});

Route::post('t/sendimage', function() {
    $photos=[InputFile::create('C:\Users\hudan\Downloads\sad.jpeg'),InputFile::create('C:\Users\hudan\Downloads\sad2.jpeg'),InputFile::create('C:\Users\hudan\Downloads\sad3.jpeg')];
    $i = session('photo_index', 0); // Oturumdan `$i` değerini al
    $chat_id='987613379';
    if ($i >= count($photos)) {
        $i = 0; // Eğer `$i` değeri fotoğraf listesinin sınırlarını aştıysa sıfırla
    }
    Telegram::sendPhoto([
        'chat_id' => $chat_id,
        'photo' => $photos[$i],
        'caption' => 'Bu şekil güne başladık'
    ]);
    $i++;
    session(['photo_index' => $i]); // Oturuma güncellenmiş `$i` değerini kaydet
    return response()->json([
        'status' => 'success',
        'message' => 'Mesaj başarıyla gönderildi'
    ]);
});

