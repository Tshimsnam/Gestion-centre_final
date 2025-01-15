<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\NotificationController;

Route::middleware('auth')->group(function () {
    Route::post('notifications/sendMail/activites', [MailController::class, 'sendMailActivite'])->name('sendMailActivite');
    Route::get('notifications/sendMail', [MailController::class, 'sendMail'])->name('sendMail');
    Route::get('notifications/autocomplete', [MailController::class, 'autocomplete'])->name('autocomplete');
    Route::get('notifications/sendSms', [SmsController::class, 'sendSms'])->name('sendSms');
    Route::get('notifications/autocompleteSms', [SmsController::class, 'autocomplete'])->name('autocompleteSms');
    Route::resource('notifications', NotificationController::class);
})->middleware('permissions');

require __DIR__ . '/auth.php';

