<?php

namespace App\Http\Controllers;

use App\Models\Oglas;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends BaseController
{

    public function brojOglasa(){
        return Oglas::where('active', '=', 1)->count();

    }
    public function brojKorisnika(){
        return User::count();
    }
    public function index(){
        $this->data['brojOglasa'] = $this->brojOglasa();
        $this->data['brojKorisnika'] = $this->brojKorisnika();

        return view('user.homepage', $this->data);
    }
    public function autor(){
        return view('user.autor', $this->data);
    }
    public function docs(){
        return response()->file(public_path() . '\dokumentacija.pdf');
    }
}
