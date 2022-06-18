<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sigurnost extends Model
{
    use HasFactory;

    protected $table = 'sigurnost';
    protected $fillable = ['naziv'];
    public function oglas(){
        return $this->belongsToMany(Oglas::class,'auto_oglas_sigurnost','auto_oglas_id', 'sigurnost_id');
    }
}
