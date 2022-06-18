<?php

namespace App\Http\Controllers;

use App\Http\Requests\DodajAdminRequest;
use App\Models\Oglas;
use App\Models\Sigurnost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SigurnostController extends Controller
{
    public function dodaj(DodajAdminRequest $request){
        $sigurnost = $request->get('zapis');

        DB::beginTransaction();
        try{
            $postoji = Sigurnost::where('naziv', 'like', $sigurnost)->count();
            if($postoji){
                return back()->with('msg', 'Zapis sa istim nazivom vec postoji.');
            }
            Sigurnost::create([
                'naziv' => $sigurnost
            ]);

            $akcija = 'je uneo novu sigurnosnu opremu';
            \App\Models\AkcijaKorisnika::create([
                'korisnik_id' => session()->get('korisnik')->id,
                'naziv' => $akcija
            ]);
            DB::commit();
            return back()->with(['message' => 'Uspesno ste dodali sigurnosnu opremu.', 'success' => true]);
        }
        catch (\Exception $exception){
            dd($exception);
            DB::rollBack();
            Log::error($exception->getMessage());
        }
    }
    public function izmeni(DodajAdminRequest $request){
        $naziv = $request->input('zapis');
        $id = $request->route('id');

        $oprema = Sigurnost::where('id', '=', $id)->first();

        if($oprema == null){
            return redirect()->route('index');
        }
        $akcija = 'je izmenio sigurnosnu opremu \''.$oprema->naziv.'\'';
        $oprema->update([
            'naziv' => $naziv
        ]);

        $akcija .='u \''.$oprema->naziv.'\'';
        \App\Models\AkcijaKorisnika::create([
            'korisnik_id' => session()->get('korisnik')->id,
            'naziv' => $akcija
        ]);
        return redirect()->route('sigurnost')->with(['message' => 'Uspesno ste izmenili sigurnosnu opremu.', 'success' => true]);

    }
    public function obrisi(Request $request){
        $id = $request->input('id');
        $postojiAktivanOglas = Oglas::whereHas('sigurnost', function($query) use($id){
            $query->where('sigurnost.id' , '=', $id)
                ->where('active', '=', 1);
        })->count();

        if($postojiAktivanOglas){
            return redirect()->route('sigurnost')->with('message', 'Nije moguce obrisati sigurnosnu opremu zbog postojanja aktivnih oglasa sa tom opremom.');
        }
        $oprema = Sigurnost::where('id', '=', $id)->first();

        Sigurnost::where('id', '=', $id)->delete();
        $akcija ='je obrisao sigurnosnu opremu \''.$oprema->naziv.'\'';
        \App\Models\AkcijaKorisnika::create([
            'korisnik_id' => session()->get('korisnik')->id,
            'naziv' => $akcija
        ]);
        return redirect()->route('sigurnost')->with(['message' => 'Uspesno ste obrisali sigurnosnu opremu.', 'success' => true]);
    }
    public function form(Request $request){
        $id = $request->get('id');
        $sigurnost = Sigurnost::where('id', '=', $id)->first();

        if($sigurnost == null){
            return redirect()->route('index');
        }

        return redirect()->route('sigurnost')->with(['izmeni' => $sigurnost, 'id' => $id]);
    }
}
