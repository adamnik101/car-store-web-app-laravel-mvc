<?php

use App\Http\Middleware\Auth;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\NotAuth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('index');


Route::get("/pretraga", [\App\Http\Controllers\PretragaController::class, 'index'])->name('pretraga');
Route::get("/pretraga/prikaz",[\App\Http\Controllers\PretragaController::class, 'pretraga'])->name("izvrsiPretragu");
// za ajax pretragu
Route::get("/pretraga/model/{id}",[\App\Http\Controllers\PretragaController::class, 'pretraziModel']);

Route::get('/auto-oglasi/prikaz/{id}', [\App\Http\Controllers\OglasController::class, 'prikaziOglas'])->name('prikazOglasa');
Route::get('/autor', [\App\Http\Controllers\IndexController::class, 'autor'])->name('autor');
Route::get('/docs', [\App\Http\Controllers\IndexController::class, 'docs'])->name('docs');
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [\App\Http\Controllers\ContactController::class, 'send'])->name('posaljiMail');
//do Login
Route::middleware([NotAuth::class])->group(function(){
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/logovanje', [\App\Http\Controllers\AuthController::class, 'doLogin'])->name('doLogin');
    Route::post('/register/user', [\App\Http\Controllers\AuthController::class, 'doRegister'])->name('doRegister');
    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
});

Route::middleware([IsAdmin::class])->group(function(){
    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin');

    Route::get('/admin/korisnici', [\App\Http\Controllers\AdminController::class, 'korisnici'])->name('korisnici');
    Route::get('/admin/korisnici/izmeni/{id}', [\App\Http\Controllers\AdminController::class, 'izmenaKorisnika'])->name('izmeniKorisnika');
    Route::post('/admin/korisnici/izmeni/{id}', [\App\Http\Controllers\KorisnikController::class, 'izmeni'])->name('izmenaKorisnika');
    Route::post('/admin/korisnici/obrisi/{id}', [\App\Http\Controllers\KorisnikController::class, 'obrisi'])->name('obrisiKorisnika');

    Route::get('/admin/oglasi', [\App\Http\Controllers\AdminController::class, 'oglasi'])->name('oglasi');
    Route::get('/admin/korisnici/akcije', [\App\Http\Controllers\AdminController::class, 'akcije'])->name('akcije');

    Route::get('/admin/proizvodjaci', [\App\Http\Controllers\AdminController::class, 'proizvodjaci'])->name('proizvodjaci');
    Route::post('/admin/proizvodjaci/dodaj', [\App\Http\Controllers\ProizvodjacController::class, 'dodaj'])->name('proizvodjacDodaj');
    Route::post('/admin/proizvodjaci/obrisi', [\App\Http\Controllers\ProizvodjacController::class, 'obrisi'])->name('proizvodjacObrisi');
    Route::get('/admin/proizvodjaci/izmeni', [\App\Http\Controllers\ProizvodjacController::class, 'form'])->name('proizvodjacIzmeniForma');
    Route::post('/admin/proizvodjaci/izmeni/{id}', [\App\Http\Controllers\ProizvodjacController::class, 'izmeni'])->name('proizvodjacIzmeni');

    Route::get('/admin/modeli', [\App\Http\Controllers\AdminController::class, 'modeli'])->name('modeli');
    Route::post('/admin/modeli/dodaj', [\App\Http\Controllers\ModelController::class, 'dodaj'])->name('modeliDodaj');
    Route::post('/admin/modeli/obrisi', [\App\Http\Controllers\ModelController::class, 'obrisi'])->name('modeliObrisi');
    Route::get('/admin/modeli/izmeni', [\App\Http\Controllers\ModelController::class, 'form'])->name('modeliIzmeniForma');
    Route::post('/admin/modeli/izmeni/{id}', [\App\Http\Controllers\ModelController::class, 'izmeni'])->name('modeliIzmeni');

    Route::get('/admin/oprema', [\App\Http\Controllers\AdminController::class, 'oprema'])->name('oprema');
    Route::post('/admin/oprema/dodaj', [\App\Http\Controllers\OpremaController::class, 'dodaj'])->name('opremaDodaj');
    Route::post('/admin/oprema/obrisi', [\App\Http\Controllers\OpremaController::class, 'obrisi'])->name('opremaObrisi');
    Route::get('/admin/oprema/izmeni', [\App\Http\Controllers\OpremaController::class, 'form'])->name('opremaIzmeniForma');
    Route::post('/admin/oprema/izmeni/{id}', [\App\Http\Controllers\OpremaController::class, 'izmeni'])->name('opremaIzmeni');

    Route::get('/admin/sigurnost', [\App\Http\Controllers\AdminController::class, 'sigurnost'])->name('sigurnost');
    Route::post('/admin/sigurnost/dodaj', [\App\Http\Controllers\SigurnostController::class, 'dodaj'])->name('sigurnostDodaj');
    Route::post('/admin/sigurnost/obrisi', [\App\Http\Controllers\SigurnostController::class, 'obrisi'])->name('sigurnostObrisi');
    Route::get('/admin/sigurnost/izmeni', [\App\Http\Controllers\SigurnostController::class, 'form'])->name('sigurnostIzmeniForma');
    Route::post('/admin/sigurnost/izmeni/{id}', [\App\Http\Controllers\SigurnostController::class, 'izmeni'])->name('sigurnostIzmeni');

    Route::get('/admin/korisnici/akcije/filter', [\App\Http\Controllers\AkcijaKorisnika::class, 'filter'])->name('filterDatumAkcije');
});
//Profil
Route::middleware([Auth::class])->group(function(){
    Route::get('/logout',[\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('/profil', [\App\Http\Controllers\KorisnikController::class, 'profil'])->name('profil');
    Route::get('/auto-oglasi/dodaj', [\App\Http\Controllers\OglasController::class, 'forma'])->name('formaOglas');
    Route::post("/auto-oglasi/unos", [\App\Http\Controllers\OglasController::class, 'unos'])->name('unosOglasa');
    Route::post('/auto-oglasi/unos/slika', [\App\Http\Controllers\UnosSlikaController::class, 'store'])->name('unosSlika');
    Route::get('/auto-oglasi/izmena/{id}', [\App\Http\Controllers\OglasController::class, 'izmeni'])->name('izmeniOglasForma');
    Route::post('/auto-oglasi/izmena/{id}/izmeni', [\App\Http\Controllers\OglasController::class, 'izmena'])->name('izmenaOglasa');
    Route::post('/auto-oglasi/obrisi/{id}', [\App\Http\Controllers\OglasController::class, 'obrisi'])->name('obrisiOglas');
    Route::get("/auto-oglasi/model/{id}",[\App\Http\Controllers\OglasController::class, 'pretraziModelZaUnos'])->name('pretraziModelUnos');
});


