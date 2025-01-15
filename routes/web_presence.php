<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\Api\PresenceAutocomplete;
use FontLib\Table\Type\name;



Route::get('/activite/{activiteId}/candidat/{candidatId}', [QrCodeController::class, 'ScanerQrcode'])->name('scaner.qrcode');

Route::get('codeqr', [QrCodeController::class, 'index'])->name('codeqr')->middleware('permissions');
Route::get('participant/{id}', [QrCodeController::class, 'participant'])->name('participant');
Route::post('confirm-presence/{id}', [QrCodeController::class, 'store'])->name('storeqrcode');
Route::post('presences/update', [PresenceController::class, 'updatePresences'])->name('presences.update');
// Route::resource('presences', PresenceController::class)->middleware('permissions');
Route::get('create/{id}', [PresenceController::class, 'create'])->name('create');
Route::get('presences', [PresenceController::class, 'index'])->name('presences.index');
Route::post('store/', [PresenceController::class, 'store'])->name('presences.store');
Route::post('userlocal', [PresenceController::class, 'userlocal'])->name('userlocal');
Route::get('security', [PresenceController::class, 'security'])->name('security');
Route::get('scanner', function () {
    return view('presences.camera');
})->name('scanner');
Route::get('generercodeqr/{id}',[QrCodeController::class, 'generercodeqr'])->name('generercodeqr');
Route::get('deleteqrcode',[QrCodeController::class, 'deleteqrcode'])->name('deleteqrcode');
// client routes
Route::post('/filtrer/{id}', [PresenceController::class, 'filtrer'])->name('filtrer');
Route::get('/activitencours', [PresenceController::class, 'encours'])->name('activitencours');
Route::get('/confirmation', [PresenceController::class, 'confirmation'])->name('confirmation');
