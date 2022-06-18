<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slika extends Model
{
    use HasFactory;
    protected $table = 'slika';
    protected $fillable = [
        'url','main','auto_oglas_id'
    ];
    public function oglas(){
        return $this->belongsTo(Slika::class, 'auto_oglas_id');
    }

    public static function upload($image){
        $imageName = time(). '_' . $image->getClientOriginalName();
        $result = $image->move(public_path() . "/assets/img/oglasi/", $imageName);

        if($result){
            return $imageName;
        }
        return false;
    }
}
