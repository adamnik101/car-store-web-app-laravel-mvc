<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    use HasFactory;
    protected $table = 'navigation';

    public function getNavigation(){
        return \DB::table("navigation")
            ->select("name", "route")
            ->get();
    }
}
