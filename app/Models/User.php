<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'korisnik';

    protected $fillable = [
        'ime',
        'prezime',
        'lozinka',
        'email',
        'telefon',
        'id_uloga'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'lozinka'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime:d/m/Y',
    ];

    public function oglas(){
        return $this->hasMany(Oglas::class, 'korisnik_id');
    }
    public function akcija(){
        return $this->hasMany(AkcijaKorisnika::class, 'korisnik_id');
    }
    public function uloga(){
        return $this->belongsTo(Uloga::class, 'id_uloga');
    }
}
