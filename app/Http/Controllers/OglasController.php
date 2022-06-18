<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOglasRequest;
use App\Models\AutoModel;
use App\Models\Boja;
use App\Models\Grad;
use App\Models\Klima;
use App\Models\Oglas;
use App\Models\OglasOprema;
use App\Models\OglasSigurnost;
use App\Models\Oprema;
use App\Models\Proizvodjac;
use App\Models\Sigurnost;
use App\Models\Slika;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Psy\Util\Json;

class OglasController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        $this->data['grad'] = Grad::orderBy('naziv')->get();

        $this->data['klima'] = Klima::all();

        $this->data['boja'] = Boja::all();

        $this->data['sigurnost'] = Sigurnost::all();

        $this->data['oprema'] = Oprema::all();
    }

    public function prikaziOglas(Request $request){
        $oglasId = $request->route('id');
        try{
            $oglas = Oglas::with('model.proizvodjac','korisnik', 'slika', 'pogon', 'vrata', 'karoserija', 'klima', 'menjac', 'gorivo', 'boja', 'grad', 'godiste')
                ->where('id', '=', $oglasId)
                ->where('active', '=', 1)
                ->get();

            if($oglas->isEmpty()){
                return redirect()->route('index');
            }
            $this->data['oglas'] = $oglas;
            return view('oglas.oglas', $this->data);
        }
        catch (\Exception $exception){
            Log::error($exception->getMessage());
           return redirect()->route('index');
        }
    }

    public function forma(){
        $this->data['marka'] = Proizvodjac::where('active', '=', 1)->whereHas('model', function($query){
            $query->where('active', '=', 1);
        })->orderBy('naziv')->get();
        $this->data['model'] = AutoModel::all();
        return view('oglas.forma-dodaj', $this->data);
    }

    public function unos(StoreOglasRequest $request){
        try{
            $images = [];
            if($request->slika == null){
                return redirect()->route('formaOglas');
            }
            foreach ($request->slika as $s){
                array_push($images, Slika::upload($s));
            }

            $oglas = $request;
            DB::beginTransaction();
            try{
                $noviOglas = Oglas::create([
                    'model_id' => $request->model,
                    'gorivo_id' => $request->gorivo,
                    'auto_tip_id' => $request->karoserija,
                    'br_vrata_id' => $request->brojVrata,
                    'godiste_id' => $request->godiste,
                    'pogon_id' => $request->pogon,
                    'boja_id' => $request->boja,
                    'klima_id' => $request->klima,
                    'menjac_id' => $request->menjac,
                    'kilometraza' => $request->kilometraza,
                    'registrovan_do' => $request->registrovanDo,
                    'obelezje' => $request->obelezje,
                    'grad_id' => $request->grad,
                    'cena' => $request->cena,
                    'korisnik_id' => session()->get('korisnik')->id,
                    'opis' => $request->opis
                ]);

                foreach ($oglas->sigurnost as $s){
                    OglasSigurnost::create([
                       'auto_oglas_id' => $noviOglas->id,
                        'sigurnost_id' => $s
                    ]);
                }
                foreach ($images as $image => $val){
                    Slika::create([
                        'url' => $val,
                        'main' => $image == 0 ? "1": "0",
                        'auto_oglas_id' => $noviOglas->id
                    ]);
                }

                foreach ($oglas->oprema as $o){
                    OglasOprema::create([
                       'auto_oglas_id' => $noviOglas->id,
                       'oprema_id' => $o
                    ]);
                }

                $akcija = 'je postavio/la novi oglas';
                \App\Models\AkcijaKorisnika::create([
                    'korisnik_id' => session()->get('korisnik')->id,
                    'naziv' => $akcija
                ]);
                DB::commit();
                return redirect()->route('prikazOglasa', ['id' => $noviOglas->id]);
            }
            catch (\Exception $exception){
                dd($exception);
                DB::rollBack();
                Log::error($exception->getMessage());
            }
        }
        catch (\Exception $exception){
            dd($exception);
            Log::error($exception->getMessage());
        }
    }

    public function izmeni(Request $request){
        $this->data['marka'] = Proizvodjac::whereHas('model', function($query){
            $query->where('active', '=', 1);
        })->where('active', '=', 1)->orderBy('naziv')->get();
        $this->data['model'] = AutoModel::all();
        $oglasId = $request->route('id');
        try{
            $oglas = Oglas::with('model.proizvodjac','korisnik', 'slika', 'pogon', 'vrata', 'karoserija', 'klima', 'menjac', 'gorivo', 'boja', 'grad', 'godiste')
                ->where('id', '=', $oglasId)
                ->where('active', '=' , 1)
                ->get();
            if($oglas->isEmpty()){
                return redirect()->route('index');
            }
            if($oglas[0]->korisnik_id == session()->get('korisnik')->id || session()->get('korisnik')->id_uloga == 2){
                $this->data['oglas'] = $oglas;
                return view('oglas.izmeni', $this->data);
            }
            return redirect()->route('index');
        }
        catch (\Exception $exception){
            Log::error($exception->getMessage());
        }

    }
    public function izmena(StoreOglasRequest $request){
        $oglas = $request;
        $images = [];

        if($request->has('slika')){
            foreach ($request->slika as $s){
                array_push($images, Slika::upload($s));
            }
        }

        $noviOglas = Oglas::find($oglas->id);
        DB::beginTransaction();
        try {
                $noviOglas->update([
                'model_id' => $request->model,
                'gorivo_id' => $request->gorivo,
                'auto_tip_id' => $request->karoserija,
                'br_vrata_id' => $request->brojVrata,
                'godiste_id' => $request->godiste,
                'pogon_id' => $request->pogon,
                'boja_id' => $request->boja,
                'klima_id' => $request->klima,
                'menjac_id' => $request->menjac,
                'kilometraza' => $request->kilometraza,
                'registrovan_do' => $request->registrovanDo,
                'obelezje' => $request->obelezje,
                'grad_id' => $request->grad,
                'cena' => $request->cena,
                'opis' => $request->opis
            ]);
            OglasSigurnost::where('auto_oglas_id', '=', $noviOglas->id)->delete();

            foreach ($oglas->sigurnost as $s) {
                OglasSigurnost::create([
                    'auto_oglas_id' => $noviOglas->id,
                    'sigurnost_id' => $s
                ]);
            }
            if($request->has('slika')){
                Slika::where('auto_oglas_id', "=", $noviOglas->id)->delete();
                foreach ($images as $image => $val){
                    Slika::create([
                        'url' => $val,
                        'main' => $image == 0 ? "1": "0",
                        'auto_oglas_id' => $noviOglas->id
                    ]);
                }
            }

            OglasOprema::where('auto_oglas_id', '=', $noviOglas->id)->delete();
            foreach ($oglas->oprema as $o) {
                OglasOprema::create([
                    'auto_oglas_id' => $noviOglas->id,
                    'oprema_id' => $o
                ]);
            }

            DB::commit();
            return redirect()->route('prikazOglasa', ['id' => $noviOglas->id]);
        }
        catch (\Exception $exception){
            DB::rollBack();
            dd($exception->getMessage());
            Log::error($exception->getMessage());
        }
    }
    public function obrisi(Request $request){
        $this->data['korisnik'] = session()->get('korisnik');
        $id = $request->route('id');

        try{
            $oglas = Oglas::find($id);

            if(is_null($oglas)){
                return redirect()->route('index');
            }

            if($oglas->korisnik_id == session()->get('korisnik')->id){
                Oglas::where('id', '=', $id)->update([
                    'active' => 0
                ]);
                $akcija = 'je obrisao/la oglas.';

                \App\Models\AkcijaKorisnika::create([
                   'korisnik_id' => session()->get('korisnik')->id,
                    'naziv' => $akcija
                ]);
                return redirect()->route('profil')->with(['message' => 'Uspesno ste obrisali oglas.', 'success' => true]);
            }
            return redirect()->route('index');
        }
        catch (\Exception $exception){

            Log::error($exception->getMessage());
        }
    }
    public function pretraziModelZaUnos(Request $request){
        $modeli = AutoModel::where('proizvodjac_id', '=', $request->get('id'))->where('active', '=', 1)->distinct()->orderBy('naziv', 'asc')->get();
        return Json::encode($modeli);
    }
}
