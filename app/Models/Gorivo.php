<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gorivo extends Model
{
    use HasFactory;
    protected $table = "gorivo";

    public function oglas(){
        return $this->hasMany(Oglas::class);
    }
}
