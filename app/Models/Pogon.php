<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pogon extends Model
{
    use HasFactory;
    protected $table = "pogon";

    public function oglas(){
        return $this->hasMany(Oglas::class, 'pogon_id');
    }
}
