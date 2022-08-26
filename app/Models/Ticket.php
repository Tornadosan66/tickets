<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Status;
class Ticket extends Model
{
    use HasFactory;
    use SoftDeletes;

         public function responsable(){
        return $this->belongsTo(User::class,'responsable_id');
    }
     public function solicitante(){
        return $this->belongsTo(User::class,'solicitante_id');
    }

     public function status(){
        return $this->belongsTo(Status::class,'status_id');
    }
         
}
