<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klima extends Model
{
    use HasFactory;

    protected $table = 'klima';

    public function oglas(){
        return $this->hasMany(Oglas::class);
    }
}
