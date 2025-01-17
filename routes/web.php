<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CarteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OLTController;
use App\Http\Controllers\Admin\HubController;
use App\Http\Controllers\Admin\SubBoxController;

Route::get('/', [DashboardController::class, 'updateEquipmentOrder'])->name('adminHome');
Route::get('/chaine/map', [DashboardController::class, 'chaineMap'])->name('chaineMap');
// Route::get('/chaineMap', function () {
//     return view('/Admin/layout/chaineMap',['page' => 'olts']);
// })->name('chaineMap');
// OLT
Route::get('/olts', [OLTController::class, 'getOLTs'])->name('olts');
Route::get('/ajouterOLT', [OLTController::class, 'addOLT'])->name('ajouterOLT');
Route::post('/oltS', [OLTController::class, 'storeOLT'])->name('olt.store');
Route::post('/oltU', [OLTController::class, 'updateOLT'])->name('olt.update');
Route::get('/modifierOLT/{id}', [OLTController::class, 'getOLTId'])->name('modifierOLT');
Route::get('/supprimerOLT/{id}', [OLTController::class, 'deleteOLT'])->name('supprimerOLT');

// Carte
Route::get('/cartes', [CarteController::class, 'getCartes'])->name('cartes');
Route::get('/ajouterCarte', function () {
    return view('/Admin/Carte/ajouterCarte',['page' => 'cartes']);
})->name('ajouterCarte');
Route::post('/carteS', [CarteController::class, 'storeCarte'])->name('carte.store');
Route::post('/clientU', [CarteController::class, 'updateCarte'])->name('carte.update');
Route::get('/modifierCarte/{id}', [CarteController::class, 'getCarteId'])->name('modifierCarte');
Route::get('/supprimerCarte/{id}', [CarteController::class, 'deleteCarte'])->name('supprimerCarte');

// Hub
Route::get('/hubs', [HubController::class, 'getHubs'])->name('hubs');
Route::get('/ajouterHub', [HubController::class, 'addHub'])->name('ajouterHub');
Route::post('/hubS', [HubController::class, 'storeHub'])->name('hub.store');
Route::post('/hubU', [HubController::class, 'updateHub'])->name('hub.update');
Route::get('/modifierHub/{id}', [HubController::class, 'getHubId'])->name('modifierHub');
Route::get('/supprimerHub/{id}', [HubController::class, 'deleteHub'])->name('supprimerHub');

// SubBox
Route::get('/subBoxs', [SubBoxController::class, 'getSubBoxs'])->name('subBoxs');
Route::get('/ajouterSubBox', [SubBoxController::class, 'addSubBox'])->name('ajouterSubBox');
Route::post('/subBoxS', [SubBoxController::class, 'storeSubBox'])->name('subBox.store');
Route::post('/subBoxU', [SubBoxController::class, 'updateSubBox'])->name('subBox.update');
Route::get('/modifierSubBox/{id}', [SubBoxController::class, 'getSubBoxId'])->name('modifierSubBox');
Route::get('/supprimerSubBox/{id}', [SubBoxController::class, 'deleteSubBox'])->name('supprimerSubBox');
