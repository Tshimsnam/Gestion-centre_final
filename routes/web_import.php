<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportControl;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ImportController;


Route::get('import', [ImportControl::class, 'index'])->name('import');
Route::post('import', [ImportControl::class, 'import'])->name('import');
Route::get('import', [ImportControl::class, 'indexacti'])->name('import.activite');
//Route::post('activites/import', [ImportControl::class, 'importInActivity'])->name('activites.import')->middleware('permissions');;
//Route::get('/download/{filename}', [ImportControl::class, 'download'])->name('file.download');
//Route::post('/export', [ImportControl::class, 'download'])->name('export');
Route::post('/export', [ImportControl::class, 'exportModel'])->name('export');
Route::post('/exportParticipant', [ImportControl::class, 'exportParticipant'])->name('exportParticipant');
Route::post('/importAndgenerate', [ImportControl::class, 'importAndgenerate'])->name('importAndgenerate');
Route::get('/generateAllCertificat/{id}', [ImportControl::class, 'generateAllCertificats'])->name('allCertificats');
Route::post('/import-participants', [ImportControl::class, 'importParticipantsFromExcel'])->name('import.participants');

