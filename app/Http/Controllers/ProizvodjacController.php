<?php

namespace App\Http\Controllers;

use App\Http\Requests\DodajAdminRequest;
use App\Models\AutoModel;
use App\Models\Oglas;
use App\Models\Proizvodjac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProizvodjacController extends Controller
{
    //
    public function dodaj(DodajAdminRequest $request){
        $proizvodjac = $request->get('zapis');

        DB::beginTransaction();
        try{
            $postoji = Proizvodjac::where('naziv', 'like', $proizvodjac)->where('active', '=', 1)->count();
            if($postoji){
                return back()->with('msg', 'Zapis sa istim nazivom vec postoji.');
            }
            Proizvodjac::create([
                'naziv' => $proizvodjac
            ]);

            $akcija = 'je uneo novog proizvodjaca \''.$proizvodjac.'\'';
            \App\Models\AkcijaKorisnika::create([
                'korisnik_id' => session()->get('korisnik')->id,
                'naziv' => $akcija
            ]);
            DB::commit();
            return back()->with(['message' => 'Uspesno ste dodali novog proizvodjaca.', 'success' => true]);
        }
        catch (\Exception $exception){
            DB::rollBack();
            Log::error($exception->getMessage());
        }
    }

    public function obrisi(Request $request){
        $id = $request->input('id');
        $postojiAktivanOglas = Oglas::whereHas('model', function($query) use($id){
            $query->where('model.proizvodjac_id' , '=', $id)
            ->where('active', '=', 1);
        })->count();

        if($postojiAktivanOglas){
            return back()->with('message', 'Nije moguce obrisati proizvodjaca zbog postojanja aktivnih oglasa.');
        }
        $proizvodjac = Proizvodjac::where('id', '=', $id)->first();
            Proizvodjac::where('id', '=', $id)->update([
           'active' => 0
        ]);
        $akcija ='je obrisao proizvodjaca \''.$proizvodjac->naziv.'\'';
        \App\Models\AkcijaKorisnika::create([
            'korisnik_id' => session()->get('korisnik')->id,
            'naziv' => $akcija
        ]);
        return back()->with(['message' => 'Uspesno ste obrisali proizvodjaca.', 'success' => true]);
    }

    public function izmeni(DodajAdminRequest $request){
        $naziv = $request->input('zapis');
        $id = $request->route('id');



        $proizvodjac = Proizvodjac::where('id', '=', $id)->first();

        if($proizvodjac == null){
            return redirect()->route('index');
        }
        $akcija = 'je izmenio proizvodjaca \''.$proizvodjac->naziv.'\'';
        $proizvodjac->update([
            'naziv' => $naziv
        ]);

        $akcija .='u \''.$proizvodjac->naziv.'\'';
        \App\Models\AkcijaKorisnika::create([
            'korisnik_id' => session()->get('korisnik')->id,
            'naziv' => $akcija
        ]);
        return redirect()->route('proizvodjaci')->with(['message' => 'Uspesno ste izmenili proizvodjaca.', 'success' => true]);

    }

    public function form(Request $request){
        $id = $request->get('id');
        $oglas = Proizvodjac::where('id', '=', $id)->first();

        if($oglas == null){
            return redirect()->route('index');
        }

        return back()->with(['izmeni' => $oglas, 'id' => $id]);
    }
}
