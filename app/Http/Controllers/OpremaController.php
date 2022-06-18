<?php

namespace App\Http\Controllers;

use App\Http\Requests\DodajAdminRequest;
use App\Models\Oglas;
use App\Models\Oprema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;

class OpremaController extends Controller
{
    public function dodaj(DodajAdminRequest $request){
        $opremaNaziv = $request->get('zapis');

        DB::beginTransaction();
        try{
            $postoji = Oprema::where('naziv', 'like', $opremaNaziv)->count();
            if($postoji){
                return back()->with('msg', 'Zapis sa istim nazivom vec postoji.');
            }

            Oprema::create([
                'naziv' => $opremaNaziv
            ]);

            $akcija = 'je uneo novu opremu';
            \App\Models\AkcijaKorisnika::create([
               'korisnik_id' => session()->get('korisnik')->id,
               'naziv' => $akcija
            ]);
            DB::commit();
            return back()->with(['message' => 'Uspesno ste dodali novu dodatnu opremu.', 'success' => true]);
        }
        catch (Exception $exception){
            DB::rollBack();
            Log::error($exception->getMessage());
        }
    }
    public function izmeni(DodajAdminRequest $request){
        $naziv = $request->input('zapis');
        $id = $request->route('id');

        $oprema = Oprema::where('id', '=', $id)->first();

        if($oprema == null){
            return redirect()->route('index');
        }
        $akcija = 'je izmenio dodatnu opremu \''.$oprema->naziv.'\'';
        $oprema->update([
            'naziv' => $naziv
        ]);

        $akcija .='u \''.$oprema->naziv.'\'';
        \App\Models\AkcijaKorisnika::create([
            'korisnik_id' => session()->get('korisnik')->id,
            'naziv' => $akcija
        ]);
        return redirect()->route('oprema')->with(['message' => 'Uspesno ste izmenili dodatnu opremu.', 'success' => true]);

    }
    public function obrisi(Request $request){
        $id = $request->input('id');
        $postojiAktivanOglas = Oglas::whereHas('oprema', function($query) use($id){
            $query->where('oprema.id' , '=', $id)
                ->where('active', '=', 1);
        })->count();

        if($postojiAktivanOglas){
            return back()->with('message', 'Nije moguce obrisati dodatnu opremu zbog postojanja aktivnih oglasa sa tom opremom.');
        }
        $oprema = Oprema::where('id', '=', $id)->first();

        Oprema::where('id', '=', $id)->delete();
        $akcija ='je obrisao dodatnu opremu \''.$oprema->naziv.'\'';
        \App\Models\AkcijaKorisnika::create([
            'korisnik_id' => session()->get('korisnik')->id,
            'naziv' => $akcija
        ]);
        return back()->with(['message' => 'Uspesno ste obrisali dodatnu opremu.', 'success' => true]);
    }
    public function form(Request $request){
        $id = $request->get('id');
        $oprema = Oprema::where('id', '=', $id)->first();

        if($oprema == null){
            return redirect()->route('index');
        }
        return back()->with(['izmeni' => $oprema, 'id' => $id]);
    }
}
