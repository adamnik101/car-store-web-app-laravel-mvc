<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grad extends Model
{
    use HasFactory;

    protected $table = 'grad';

    public function oglas(){
        return $this->hasMany(Oglas::class);
    }
}
