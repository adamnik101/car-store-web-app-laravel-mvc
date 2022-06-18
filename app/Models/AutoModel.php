<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoModel extends Model
{
    use HasFactory;

    protected $table = 'model';
    protected $fillable = ['naziv', 'proizvodjac_id'];

    public function proizvodjac()
    {
        return $this->belongsTo(Proizvodjac::class, 'proizvodjac_id', 'id');
    }
    public function oglas(){
        return $this->hasMany(Oglas::class, 'model_id');
    }
}
