<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CarteController;
use App\Http\Controllers\Admin\OLTController;

Route::get('/', function () {
    return view('/Admin/dashboard');
});

// OLT
Route::get('/olts', [OLTController::class, 'getOLTs'])->name('olts');
Route::get('/ajouterOLT', function () {
    return view('/Admin/OLT/ajouterOLT');
})->name('ajouterOLT');
Route::post('/oltS', [OLTController::class, 'storeOLT'])->name('olt.store');
Route::post('/clientU', [OLTController::class, 'updateOLT'])->name('olt.update');
Route::get('/modifierOLT/{id}', [OLTController::class, 'getOLTId'])->name('modifierOLT');
Route::get('/supprimerOLT/{id}', [OLTController::class, 'deleteOLT'])->name('supprimerOLT');

// Carte
Route::get('/cartes', [CarteController::class, 'getCartes'])->name('cartes');
Route::get('/ajouterCarte', function () {
    return view('/Admin/Carte/ajouterCarte');
})->name('ajouterCarte');
Route::post('/carteS', [CarteController::class, 'storeCarte'])->name('carte.store');
Route::post('/clientU', [CarteController::class, 'updateCarte'])->name('carte.update');
Route::get('/modifierCarte/{id}', [CarteController::class, 'getCarteId'])->name('modifierCarte');
Route::get('/supprimerCarte/{id}', [CarteController::class, 'deleteCarte'])->name('supprimerCarte');

// Hub
Route::get('/hub', function () {
    return view('/Admin/Hub/hub');
})->name('hub');
// SubBox
Route::get('/subBox', function () {
    return view('/Admin/SubBox/subBox');
})->name('subBox');
// EndBox
Route::get('/endBox', function () {
    return view('/Admin/EndBox/endBox');
})->name('endBox');
