<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\Api\OdcuserController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\HashtagController;
use App\Http\Controllers\TypeEventController;






Route::middleware('auth')->group(function () {
    Route::get('/activite/{id}/parcours',[ActiviteController::class,'critereParticipant'])->name('parcours');
    Route::get('/activite/{id}/statusupdate',[ActiviteController::class,'syncParticipant'])->name('syncandidats');
    Route::get('/categorie/{id}/activites', [CategorieController::class, 'showActivites'])->name('categorie.activites');
    Route::get('/api/activities', [ActiviteController::class, 'getActivitiesData']);
    Route::get('/activites/search', [ActiviteController::class, 'search'])->name('activites.search');
    Route::post('bookInSeat/{_id}', [ActiviteController::class, 'bookInSeat'])->name('bookInSeat');
    Route::post('IsEvent/{_id}', [ActiviteController::class, 'isEvent'])->name('IsEvent');
    Route::post('send/{_id}', [ActiviteController::class, 'status'])->name('send');
    Route::post('showInSlider/{_id}', [ActiviteController::class, 'showInSlider'])->name('showInSlider');
    Route::post('showInCalendar/{_id}', [ActiviteController::class, 'showInCalendar'])->name('showInCalendar');
    Route::resource('/activites', ActiviteController::class);
    Route::resource('/typevents', TypeEventController::class);
    Route::resource('/categories', CategorieController::class);
    Route::resource('/hashtags', HashtagController::class);
})->middleware('permissions');

Route::get('/sheet-form', function () {
    return view('test.form');
});

Route::post('/get-sheet-users', [OdcuserController::class, 'getSheetUsers'])->name('getSheetUsers');

require __DIR__ . '/auth.php';
