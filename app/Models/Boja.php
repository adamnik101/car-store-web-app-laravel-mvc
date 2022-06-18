<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boja extends Model
{
    use HasFactory;

    protected $table = 'boja';

    public function oglas(){
        return $this->hasMany(Oglas::class);
    }
}
