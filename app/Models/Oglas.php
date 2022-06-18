<?php

namespace App\Models;

use App\Http\Requests\StoreOglasRequest;
use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oglas extends Model
{
    use HasFactory;
    protected $table = "auto_oglas";
    protected $fillable = [
        'model_id', 'gorivo_id', 'auto_tip_id', 'br_vrata_id', 'grad_id','godiste_id', 'pogon_id', 'boja_id', 'klima_id', 'menjac_id', 'kilometraza', 'registrovan_do', 'obelezje', 'cena', 'korisnik_id', 'opis'
    ];
    public function model(){
        return $this->belongsTo(AutoModel::class, 'model_id');
    }

    public function gorivo(){
        return $this->belongsTo(Gorivo::class, 'gorivo_id');
    }

    public function karoserija(){
        return $this->belongsTo(Karoserija::class, "auto_tip_id");
    }
    public function vrata(){
        return $this->belongsTo(Vrata::class, 'br_vrata_id');
    }
    public function godiste(){
        return $this->belongsTo(Godiste::class);
    }
    public function pogon(){
        return $this->belongsTo(Pogon::class, 'pogon_id');
    }
    public function boja(){
        return $this->belongsTo(Boja::class, 'boja_id');
    }
    public function grad(){
        return $this->belongsTo(Grad::class,'grad_id');
    }
    public function klima(){
        return $this->belongsTo(Klima::class, 'klima_id');
    }
    public function sigurnost(){
        return $this->belongsToMany(Sigurnost::class, 'auto_oglas_sigurnost','auto_oglas_id', 'sigurnost_id');
    }
    public function oprema(){
        return $this->belongsToMany(Oprema::class, 'auto_oglas_oprema', 'auto_oglas_id', 'oprema_id');
    }

    public function slika(){
        return $this->hasMany(Slika::class, 'auto_oglas_id');
    }
    public function menjac(){
        return $this->belongsTo(Menjac::class, 'menjac_id');
    }
    public function korisnik(){
        return $this->belongsTo(User::class, 'korisnik_id');
    }
}
