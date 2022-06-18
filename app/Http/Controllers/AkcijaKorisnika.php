<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AkcijaKorisnika extends BaseController
{
    public function filter(Request $request){
        $datum = $request->datum;
        if($datum == null){
            $this->data['akcije'] = \App\Models\AkcijaKorisnika::orderBy('created_at', 'desc')->paginate(10);
            return view('admin.pages.akcije.akcije', $this->data);
        }
        try{
            $this->data['akcije'] = \App\Models\AkcijaKorisnika::with('korisnik')->where('created_at', 'like', '%'.$datum.'%')->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
            $this->data['requests'] = $request;
            return view('admin.pages.akcije.akcije', $this->data);
        }
        catch (\Exception $exception){
            Log::error($exception->getMessage());
        }
    }
}
