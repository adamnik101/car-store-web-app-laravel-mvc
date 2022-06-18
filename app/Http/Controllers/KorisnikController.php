<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Oglas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KorisnikController extends BaseController
{
    //
    public function profil(Request $request){
        $korisnik = $request->session()->get('korisnik');
        $this->data['korisnik'] = $korisnik;
        $this->data['oglasi'] = Oglas::whereHas('korisnik', function($query) use ($korisnik){
            $query->where('korisnik_id', '=', $korisnik->id)
            ->where('prodat' , '=' , 0)
            ->where('active', '=', 1);
        })->paginate(6);
        return view('user.profil', $this->data);
    }

    public function izmeni(EditUserRequest $request){
        DB::beginTransaction();
        try{
            $user = User::where('id', '=', $request->route('id'))->first();


            if($request->password_new){
                $user->update([
                    'lozinka' => md5($request->password_new)
                ]);
            }
            $user->update([
               'ime' => $request->ime,
                'prezime' => $request->prezime,
                'email' => $request->email,
                'telefon' => $request->tel,
                'id_uloga' => $request->uloga
            ]);

            DB::commit();
            $akcija = 'je izmenio korisnika.';

            \App\Models\AkcijaKorisnika::create([
                'korisnik_id' => session()->get('korisnik')->id,
                'naziv' => $akcija
            ]);
            return redirect()->route('korisnici')->with(['message' => 'Uspesno ste izmenili korisnika.', 'success' => true]);
        }
        catch (\Exception $exception){
            DB::rollBack();
            Log::error($exception->getMessage());
        }
    }
    public function obrisi(Request $request){
        $id = $request->route('id');
        $user = User::find($id);
        $akcija = '';
        DB::beginTransaction();
        if(is_null($user)){
            $akcija = 'je pokusao/la da obrise korisnika.';
            \App\Models\AkcijaKorisnika::create([
                'korisnik_id' => session()->get('korisnik')->id,
                'naziv' => $akcija
            ]);
            return redirect()->route('korisnici')->with('message', 'Korisnik ne postoji u bazi.');
        }
        try{
            $delete = \App\Models\AkcijaKorisnika::where('korisnik_id', '=', $user->id)->delete();
            if($delete){
                $user->delete();
                $akcija = 'je obrisao/la korisnika.';
                \App\Models\AkcijaKorisnika::create([
                    'korisnik_id' => session()->get('korisnik')->id,
                    'naziv' => $akcija
                ]);

                DB::commit();
                return redirect()->route('korisnici')->with(['message' => 'Uspesno ste obrisali korisnika.', 'success' => true]);
            }
            $akcija = 'je pokusao/la da obrise korisnika.';
            \App\Models\AkcijaKorisnika::create([
                'korisnik_id' => session()->get('korisnik')->id,
                'naziv' => $akcija
            ]);
            return redirect()->route('korisnici')->with('message', 'Nije uspelo brisanje korisnika.');
        }
        catch (\Exception $exception){
            DB::rollBack();
            Log::error($exception->getMessage());
        }
    }

}
