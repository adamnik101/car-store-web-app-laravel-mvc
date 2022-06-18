<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkcijaKorisnika extends Model
{
    use HasFactory;
    protected $fillable = ['korisnik_id', 'naziv'];

    protected $table = 'korisnik_akcija';


    public function korisnik(){
        return $this->belongsTo(User::class, 'korisnik_id');
    }
}
