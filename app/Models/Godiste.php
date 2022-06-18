<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Godiste extends Model
{
    use HasFactory;
    protected $table = "godiste";


    public function oglas(){
        return $this->hasMany(Oglas::class);
    }
}
