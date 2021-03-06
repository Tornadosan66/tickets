<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Planteles;
use App\Models\User;
class Area extends Model
{
    use HasFactory;
    //use SoftDeletes;


    public function planteles(){
        return $this->belongsTo(Planteles::class,'id_plantel');
    }
     public function supervisor(){
        return $this->belongsTo(User::class,'id_supervisor_area');
    }




    //Test de conflictos
}
