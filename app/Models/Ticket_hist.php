<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket_hist extends Model
{
    use HasFactory;

    protected $table = 'tickets_hist';

    /*
    public function nombreFuncion(){
        return $this->belongsTo(tablaReferencia::class,'llaveForanea','llavetablaReferencia');
    }
    */

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
