<?php

namespace App\Http\Controllers;

use App\Models\AutoModel;
use App\Models\Godiste;
use App\Models\Gorivo;
use App\Models\Karoserija;
use App\Models\Menjac;
use App\Models\Navigation;
use App\Models\Oglas;
use App\Models\Oprema;
use App\Models\Pogon;
use App\Models\Proizvodjac;
use App\Models\Vrata;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public $data = [];

    public function __construct(){

        $this->data['navigation'] = Navigation::all();

        $this->data['model'] = Proizvodjac::whereHas('model', function($query){
            $query->whereHas('oglas', function($query){
                $query->where('active', '=', 1);
            });
        })->where('active', '=', 1)->orderBy('naziv', 'asc')->get();

        $this->data['godiste'] = Godiste::all();

        $this->data['karoserija'] = Karoserija::all();

        $this->data['gorivo'] = Gorivo::all();

        $this->data['vrata'] = Vrata::all();

        $this->data['menjac'] = Menjac::all();

        $this->data['pogon'] = Pogon::all();

        $this->data['najnovijiOglasi'] = Oglas::with('model.proizvodjac', 'slika', 'menjac')->where('active', '=', 1)->orderBy('datum_postavljanja', 'desc')->paginate(10);
        //dd(Oglas::with('model.proizvodjac', 'slika')->orderBy('datum_postavljanja')->paginate(10));
        //dd(Oglas::with('model.proizvodjac')->orderBy('datum_postavljanja')->paginate(10));
        $this->data['randomOglasi'] = Oglas::with('model.proizvodjac', 'slika', 'menjac')->where('active', '=', 1)->inRandomOrder()->take(5)->get();
    }
}
