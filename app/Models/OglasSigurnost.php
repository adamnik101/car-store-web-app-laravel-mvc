<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OglasSigurnost extends Model
{
    use HasFactory;
    protected $table = 'auto_oglas_sigurnost';
    protected $fillable = [
      'auto_oglas_id',
        'sigurnost_id'
    ];
}
