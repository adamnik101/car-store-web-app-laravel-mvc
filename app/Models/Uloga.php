<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uloga extends Model
{
    use HasFactory;
    protected $table = 'uloga';

    public function user(){
        return $this->hasMany(User::class,'id_uloga');
    }
}
