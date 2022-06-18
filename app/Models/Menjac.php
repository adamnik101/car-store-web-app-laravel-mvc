<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menjac extends Model
{
    use HasFactory;
    protected $table = "menjac";

    public function oglas(){
        return $this->hasMany(Oglas::class, 'menjac_id');
    }
}
