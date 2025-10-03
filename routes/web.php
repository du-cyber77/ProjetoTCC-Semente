<?php
use App\Http\Controllers\ContatosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/sobre', function () {
    return view('sobre');
});

//Route::get('/contato', function () {
//    return view('contato');
//});

Route::get('/contato', [ContatosController::class, 'create'])->name('contato.form');
Route::post('/contato', [ContatosController::class, 'store'])->name('contato.store');

Route::get('/curiosidades', function () {
    return view('curiosidades');
});
