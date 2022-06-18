<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vrata extends Model
{
    use HasFactory;

    protected $table = "br_vrata";

    public function oglas(){
        return $this->hasMany(Oglas::class);
    }
}
