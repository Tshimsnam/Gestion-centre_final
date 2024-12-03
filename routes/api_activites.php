<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ActiviteController;

Route::apiResource('activite', ActiviteController::class)->middleware('permissions');

Route::get('recent-activites', [ActiviteController::class, 'getActiviteRecent'])->name('activite.recent');
Route::get('/getactivites', [ActiviteController::class, 'getActivite'])->name('getactivites');
Route::get('/get', [ActiviteController::class,'get'])->name("get");
Route::get('/api/parcours/{event}', [ActiviteController::class,'parcours'])->name('events.api.parcours');
Route::get('/api/cinq/{event}', [ActiviteController::class,'parcours'])->name('events.api.cinq');
Route::get('/api/nouveau/{event}', [ActiviteController::class,'parcours'])->name('events.api.nouveaux');
