<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OglasOprema extends Model
{
    use HasFactory;
    protected $table = 'auto_oglas_oprema';
    protected $fillable = [
        'auto_oglas_id',
        'oprema_id'
    ];
}
