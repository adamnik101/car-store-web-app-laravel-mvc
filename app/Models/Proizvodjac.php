<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proizvodjac extends Model
{
    use HasFactory;

    protected $table = "proizvodjac";
    protected $fillable = ['naziv'];
    public function model(){
        return $this->hasMany(AutoModel::class);
    }
}
