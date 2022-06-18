<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oprema extends Model
{
    use HasFactory;
    protected $table = "oprema";
    protected $fillable = [
      'naziv'
    ];
    public function oglas(){
        return $this->belongsToMany(Oglas::class,'auto_oglas_oprema','oprema_id', 'auto_oglas_id');
    }
}
