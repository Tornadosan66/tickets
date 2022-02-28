<?php

namespace App\Models;
use App\Models\Area;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tareas extends Model
{
    use HasFactory;
    public function area(){
        return $this->belongsTo(Area::class,'id_area');
    }
}
