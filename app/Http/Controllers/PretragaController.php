<?php

namespace App\Http\Controllers;

use App\Models\AutoModel;
use App\Models\Boja;
use App\Models\Grad;
use App\Models\Klima;
use App\Models\Oglas;
use App\Models\Oprema;
use App\Models\Proizvodjac;
use App\Models\Sigurnost;
use Illuminate\Http\Request;
use Psy\Util\Json;

class PretragaController extends BaseController
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

    public function index(){
        return view('user.search', $this->data);
    }

    public function pretraga(Request $request){
        $proizvodjac = $request->get('marka'); // 0
        $model = $request->get("model"); // 0
        $cenaOd = $request->get('cenaOd');  // null
        $cenaDo = $request->get('cenaDo');  // null
        $godisteOd = $request->get('godisteOd'); // 0
        $godisteDo = $request->get('godisteDo'); // 0
        $karoserija = $request->get('karoserija'); // 0
        $gorivo = $request->get('gorivo'); // 0
        $brojVrata = $request->get('brojVrata'); // 0
        $grad = $request->get('grad'); // 0
        $klima = $request->get('klima'); // 0
        $boja = $request->get('boja'); // 0
        $obelezje = $request->get('obelezje'); // null
        $sigurnost = $request->get('sigurnost'); // ?
        $oprema = $request->get('oprema');  // ?
        $menjac = $request->get('menjac');
        $pogon = $request->get('pogon');

        $btn = $request->get('submitDetail');
        $kriterijumi = [];
        $oglasi = Oglas::query()->where('active' , '=', 1);

        if($proizvodjac != 0){
            $oglasi
                ->whereHas('model', function ($query) use ($proizvodjac){
                    $query->whereHas('proizvodjac', function ($query) use($proizvodjac){
                        $query->where('id', "=", $proizvodjac);
                    });
                });

            array_push($kriterijumi,$proizvodjac);
        }
        if($model != 0 && $model != null){
            $oglasi->whereHas('model', function($query) use ($model){
                $query->where('id', '=', $model);
            });
        }
        if($cenaOd != null){
            $oglasi->where('cena', '>=' , $cenaOd);
            array_push($kriterijumi,$cenaOd);
        }

        if($cenaDo != null){
            $oglasi->where('cena', '<=' , $cenaDo);
            array_push($kriterijumi,$cenaDo);
        }

        if($godisteOd != 0){
            $oglasi->with('godiste')
                ->where('godiste_id' , "<=", $godisteOd);
            array_push($kriterijumi,$godisteOd);
        }

        if($godisteDo != 0){
            $oglasi->with('godiste')
                ->where('godiste_id' , ">=", $godisteDo);
            array_push($kriterijumi,$godisteDo);
        }

        if($karoserija != 0){
            $oglasi->with('karoserija')
                ->where('auto_tip_id', '=', $karoserija);
            array_push($kriterijumi,$karoserija);
        }

        if($gorivo != 0){
            $oglasi->with('gorivo')
                ->where('gorivo_id', '=', $gorivo);
            array_push($kriterijumi,$gorivo);
        }

        if($brojVrata != 0){
            $oglasi->with('vrata')
                ->where('br_vrata_id', '=', $brojVrata);
            array_push($kriterijumi,$brojVrata);
        }

        if($grad != 0){
            $oglasi->with('grad')
                ->where('grad_id', '=', $grad);
            array_push($kriterijumi,$grad);
        }

        if($klima != 0){
            $oglasi->with('klima')
                ->where('klima_id', '=', $klima);
            array_push($kriterijumi,$klima);

        }

        if($boja != 0){
            $oglasi->with('boja')
                ->where('boja_id', '=', $boja);
            array_push($kriterijumi,$boja);
        }

        if($menjac != 0){
            $oglasi->with('menjac')
                ->where('menjac_id', '=', $menjac);
        }

        if($pogon != 0){
            $oglasi->with('pogon')
                ->where('pogon_id', '=', $pogon);
        }

        if($obelezje != null){
            $oglasi->where('obelezje', 'like', '%'.$obelezje.'%');
            array_push($kriterijumi,$obelezje);
        }
        if($sigurnost != null){

            foreach ($sigurnost as $s) {
                $oglasi->with('sigurnost')
                ->whereHas('sigurnost', function ($query) use ($s){
                    $query->where('sigurnost.id', '=', $s);
                });
            }
            array_push($kriterijumi,$sigurnost);
        }

        if($oprema != null){
            foreach ($oprema as $o){
                $oglasi->with('oprema')
                    ->whereHas('oprema', function ($query) use ($o){
                   $query->where('oprema.id', '=', $o);
                });
            }
        }

        $this->data['oglasi'] = $oglasi->paginate(6)->withQueryString();
        $this->data['marka'] = AutoModel::all();
        $this->data['requests'] = $request;
        return view('oglas.pretraga-prikaz', $this->data);
    }

    public function pretraziModel(Request $request){
        $id = $request->get('id');

        $modeli = AutoModel::with('proizvodjac')->whereHas('oglas', function ($query) use ($id){
           $query->where('proizvodjac_id', '=', $id)
               ->where('active', '=', 1);
        });
        return Json::encode($modeli->get());
    }
}
