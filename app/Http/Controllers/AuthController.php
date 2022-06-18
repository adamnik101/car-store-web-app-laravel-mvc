<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthController extends BaseController
{
    //
    public function register(){
        return view('auth.register', $this->data);
    }

    public function login(){
        return view('auth.login', $this->data);
    }

    public function doLogin(LoginRequest $request){
        try{
            $user = User::where('email', '=', $request->get('email'))
                ->where('lozinka', '=', md5($request->get('lozinka')))
                ->first();

            if(!$user){
                return back()->withErrors(['err' => 'Ne postoji korisnik sa unetim podacima.']);
            }

            $request->session()->regenerate();

            $request->session()->put('korisnik', $user);
            $akcijaKorisnika = 'se ulogovao';
            try {
                \App\Models\AkcijaKorisnika::create([
                    'naziv' => $akcijaKorisnika,
                    'korisnik_id' => $request->session()->get('korisnik')->id
                ]);
            }
            catch (\Exception $exception){
                Log::error($exception->getMessage());
            }
            return redirect()->route('index');

        }
        catch (\Exception $exception){
            Log::error($exception->getMessage());
        }
    }

    public function logout(Request $request){
        $korisnik = $request->session()->get('korisnik');
        $akcijaKorisnika = ' se odjavio\la sa sajta';

        try {
            \App\Models\AkcijaKorisnika::create([
                'naziv' => $akcijaKorisnika,
                'korisnik_id' => $korisnik->id
            ]);
        }
        catch (\Exception $exception){

            Log::error($exception->getMessage());
        }

        $request->session()->remove('korisnik');

        return redirect()->route('index');
    }

    public function doRegister(UserRequest $request){
        $newUser = $request;

        DB::beginTransaction();
        try{
            $user = User::create([
               'ime' => $newUser->get('ime'),
               'prezime' => $newUser->get('prezime'),
               'email' => $newUser->get('email'),
               'telefon' => $newUser->get('tel'),
                'lozinka' => md5($newUser->get('password_confirmation'))
            ]);

            DB::commit();
            $akcija = 'se registrovao/la na sajt.';

            \App\Models\AkcijaKorisnika::create([
               'korisnik_id' => $user->id,
               'naziv' => $akcija
            ]);
            return redirect()->route('login');
        }
        catch (\Exception $exception){
            DB::rollBack();
            dd($exception);
            Log::error($exception->getMessage());
        }
    }
}
