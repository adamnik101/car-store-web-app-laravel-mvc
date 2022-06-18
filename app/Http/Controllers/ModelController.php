<?php

namespace App\Http\Controllers;

use App\Http\Requests\DodajAdminRequest;
use App\Models\AutoModel;
use App\Models\Oglas;
use App\Models\Proizvodjac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ModelController extends Controller
{
    //
    public function dodaj(DodajAdminRequest $request){
        $model = $request->get('zapis');
        $proizvodjac = $request->get('proizvodjac');

        DB::beginTransaction();
        try{
            $postojiProizvodjac = Proizvodjac::where("id", '=', $proizvodjac)->where('active', '=', 1)->get();
            if(!$postojiProizvodjac->count()){
                return back()->with('msg', 'Zapis sa izabranim proizvodjacem ne postoji.');
            }

            $postoji = AutoModel::where('naziv', 'like', $model)->where('proizvodjac_id', '=', $proizvodjac)->count();

            if($postoji){
                return back()->with('msg', 'Proizvodjac sa istim nazivom modela vec postoji.');
            }
            AutoModel::create([
               'naziv' => $model,
                'proizvodjac_id' => $proizvodjac
            ]);
            $akcija = 'je uneo novi model \''.$model.'\' proizvodjaca \''.$postojiProizvodjac[0]->naziv.'\'';
            \App\Models\AkcijaKorisnika::create([
                'korisnik_id' => session()->get('korisnik')->id,
                'naziv' => $akcija
            ]);
            DB::commit();
            return back()->with(['message' => 'Uspesno ste dodali novi model.', 'success' => true]);
        }
        catch (\Exception $exception){
            dd($exception);
            DB::rollBack();
            Log::error($exception->getMessage());
        }
    }
    public function izmeni(DodajAdminRequest $request){
        $naziv = $request->input('zapis');
        $proizvodjac = $request->input('proizvodjac');

        $id = $request->route('id');



        $model = AutoModel::where('id', '=', $id)->first();

        if($model == null){
            return redirect()->route('index');
        }

        $akcija = 'je izmenio model \''.$model->naziv.'\' u \''.$naziv.'\'';
        if($proizvodjac != $model->proizvodjac_id){
            $novi = Proizvodjac::where('id', '=', $proizvodjac)->first();
            $akcija .=' i promenio proizvodjaca tog modela u \''.$novi->naziv.'\'';
        }
        $model->update([
            'naziv' => $naziv,
            'proizvodjac_id' => $proizvodjac
        ]);

        \App\Models\AkcijaKorisnika::create([
            'korisnik_id' => session()->get('korisnik')->id,
            'naziv' => $akcija
        ]);
        return redirect()->route('modeli')->with(['message' => 'Uspesno ste izmenili izmenili model.', 'success' => true]);

    }
    public function obrisi(Request $request){
        $id = $request->get('id');
        $postojiAktivanOglas = Oglas::whereHas('model', function($query) use($id){
            $query->where('model.id' , '=', $id)
                ->where('auto_oglas.active', '=', 1);
        })->count();

        if($postojiAktivanOglas){
            return back()->with('message', 'Nije moguce obrisati model zbog postojanja aktivnih oglasa sa tim modelom.');
        }
        $model = AutoModel::where('id', '=', $id)->first();

        AutoModel::where('id', '=', $id)->update([
            'active' => 0
        ]);
        $akcija ='je obrisao model \''.$model->naziv.'\'';
        \App\Models\AkcijaKorisnika::create([
            'korisnik_id' => session()->get('korisnik')->id,
            'naziv' => $akcija
        ]);
        return back()->with(['message' => 'Uspesno ste obrisali model.', 'success' => true]);
    }
    public function form(Request $request){
        $id = $request->get('id');
        $model = AutoModel::where('id', '=', $id)->with('proizvodjac')->first();

        if($model == null){
            return redirect()->route('index');
        }
        return back()->with(['izmeni' => $model, 'id' => $id, 'model' => $model]);
    }
}
