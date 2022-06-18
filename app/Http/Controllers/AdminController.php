<?php

namespace App\Http\Controllers;

use App\Models\AutoModel;
use App\Models\Grad;
use App\Models\Oglas;
use App\Models\Oprema;
use App\Models\Proizvodjac;
use App\Models\Sigurnost;
use App\Models\Uloga;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends BaseController
{
    //
    public function index(){
        $this->data['korisnici'] = User::all();
        $this->data['oglasi'] = Oglas::where('active', '=', 1)->get();
        $this->data['registrovani24'] = User::where('created_at' ,'>=', Carbon::now()->subDay())->count();
        $this->data['logovani24'] = \App\Models\AkcijaKorisnika::select('korisnik_id')->distinct()->where('created_at' ,'>=', Carbon::now()->subDay())->get()->count();
        $this->data['noviOglasi24'] = Oglas::where('created_at', '>=', Carbon::now()->subDay())->count();
        return view('admin.pages.home', $this->data);
    }
    public function korisnici(){
        $this->data['korisnici'] = User::paginate(10);
        return view('admin.pages.korisnik.korisnici', $this->data);
    }
    public function izmenaKorisnika(Request $request){
        $id = $request->route('id');

        $korisnik = User::where('id', '!=', session()->get('korisnik')->id)->find($id);
        if($korisnik){
            $this->data['korisnik'] = $korisnik;
            $this->data['uloga'] = Uloga::all();
            return view('admin.pages.korisnik.izmena', $this->data);
        }
        return redirect()->route('admin');
    }
    public function oglasi(){
        $this->data['aktivniOglasi'] = Oglas::with('model.proizvodjac','korisnik', 'slika', 'boja', 'grad', 'godiste')
            ->where('active' , '=' , 1)
            ->orderBy('created_at', 'desc')->paginate(5, ['*'], 'aktivni')->withQueryString();
        $this->data['obrisaniOglasi'] = Oglas::with('model.proizvodjac','korisnik', 'slika', 'boja', 'grad', 'godiste')
            ->where('active' , '=' , 0)
            ->orderBy('updated_at', 'desc')->paginate(5, ['*'],'obrisani')->withQueryString();
        return view('admin.pages.oglas.oglasi', $this->data);
    }

    public function akcije(){
        $this->data['akcije'] = \App\Models\AkcijaKorisnika::with('korisnik')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pages.akcije.akcije', $this->data);
    }
    public function proizvodjaci(){
        $this->data['proizvodjaci'] = Proizvodjac::where('active', '=', 1)->orderBy('naziv')->paginate(10);

        return view('admin.pages.proizvodjaci.proizvodjaci', $this->data);
    }
    public function modeli(){
        $this->data['proizvodjaci'] = Proizvodjac::where('active', '=', 1)->orderBy('naziv')->get();
        $this->data['modeli'] = AutoModel::select('model.id AS id','model.naziv AS model', 'proizvodjac.naziv AS proizvodjac')->join('proizvodjac', 'model.proizvodjac_id' , '=', 'proizvodjac.id')->where('proizvodjac.active', '=', 1)->where('model.active', '=', 1)->orderBy('proizvodjac.naziv')->paginate(10);
        return view('admin.pages.modeli.modeli', $this->data);
    }
    public function oprema(){
        $this->data['oprema'] = Oprema::orderBy('naziv')->paginate(10);

        return view('admin.pages.oprema.oprema', $this->data);
    }
    public function sigurnost(){
        $this->data['sigurnost'] = Sigurnost::orderBy('naziv')->paginate(10);

        return view('admin.pages.sigurnost.sigurnost', $this->data);
    }
}
