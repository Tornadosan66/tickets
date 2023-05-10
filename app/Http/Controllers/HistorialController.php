<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket_hist;

class HistorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    /*

    Id_Ticket
    Pendiente
    Comentado
    En revision
    Completado
    Cancelado
    Perdido
    */
    public function index()
    {
        /*
        $idUse = Auth::id();
        $use = new User();
        $use = $use->where('id',$idUse)->first();

        $roles = $use->getRoleNames();


        //Tickets pendientes

        if($roles[0] == 'Usuario'){
            $pendientes = Ticket::where('status_id', 1)
            ->where('responsable_id', $use->id)->get();
        }else if($roles[0] == 'Supervisor'){
                $pendientes = DB::table('tickets')
             ->join('areas', function ($join){
                 $join->on('tickets.area_id', '=', 'areas.id');
                 })->join('users', function ($join){
                 $join->on('tickets.responsable_id', '=', 'users.id');
             })->select('tickets.*','users.email')->where('status_id',1)->where('areas.id_supervisor_area',$use->id)->orWhere('users.supervisor_rectoria',$idUse)->where('status_id',1)->get();
        }else if($roles[0] == 'Superusuario'){
            $pendientes = Ticket::where('status_id', 1)->get();
        }

        //Tickets completados
        
        if($roles[0] == 'Usuario'){
            $completados = Ticket::where('status_id', 2)
            ->where('responsable_id', $use->id)->get();
        }else if($roles[0] == 'Supervisor'){
            $completados = DB::table('tickets')
             ->join('areas', function ($join){
                 $join->on('tickets.area_id', '=', 'areas.id');
                 })->join('users', function ($join){
                 $join->on('tickets.responsable_id', '=', 'users.id');
             })->select('tickets.*','users.email')->where('status_id',2)->where('areas.id_supervisor_area',$use->id)->orWhere('users.supervisor_rectoria',$idUse)->where('status_id',2)->get();
        }else if($roles[0] == 'Superusuario'){
            $completados = Ticket::where('status_id', 2)->get();
        }

        //Ticekts cancelados

        if($roles[0] == 'Usuario'){
             $cancelado = Ticket::where('status_id', 3)
            ->where('responsable_id', $use->id)->get();
        }else if($roles[0] == 'Supervisor'){
            $cancelado = DB::table('tickets')
             ->join('areas', function ($join){
                 $join->on('tickets.area_id', '=', 'areas.id');
                 })->join('users', function ($join){
                 $join->on('tickets.responsable_id', '=', 'users.id');
             })->select('tickets.*','users.email')->where('status_id',3)->where('areas.id_supervisor_area',$use->id)->orWhere('users.supervisor_rectoria',$idUse)->where('status_id',3)->get();
        }else if($roles[0] == 'Superusuario'){
            $cancelado = Ticket::where('status_id', 3)->get();
        }

        //Tickets validados

        if($roles[0] == 'Usuario'){
            $validacion = Ticket::where('status_id', 4)
            ->where('responsable_id', $use->id)->get();
        }else if($roles[0] == 'Supervisor'){
            $validacion = DB::table('tickets')
             ->join('areas', function ($join){
                 $join->on('tickets.area_id', '=', 'areas.id');
                 })->join('users', function ($join){
                 $join->on('tickets.responsable_id', '=', 'users.id');
             })->select('tickets.*','users.email')->where('status_id',4)->where('areas.id_supervisor_area',$use->id)->orWhere('users.supervisor_rectoria',$idUse)->where('status_id',4)->get();
        }else if($roles[0] == 'Superusuario'){
            $validacion = Ticket::where('status_id', 4)->get();
        }

        //Tickets perdidos

        if($roles[0] == 'Usuario'){
            $perdido = Ticket::where('status_id', 5)
            ->where('responsable_id', $use->id)->get();
        }else if($roles[0] == 'Supervisor'){
            $perdido = DB::table('tickets')
             ->join('areas', function ($join){
                 $join->on('tickets.area_id', '=', 'areas.id');
                 })->join('users', function ($join){
                 $join->on('tickets.responsable_id', '=', 'users.id');
             })->select('tickets.*','users.email')->where('status_id',5)->where('areas.id_supervisor_area',$use->id)->orWhere('users.supervisor_rectoria',$idUse)->where('status_id',5)->get();
        }else if($roles[0] == 'Superusuario'){
            $perdido = Ticket::where('status_id', 5)->get();
        }



       
            $misticket = Ticket::where('solicitante_id', Auth::id())->get();

        return view('historial',compact("pendientes", "completados", "cancelado", "validacion", "perdido",'misticket'));
    */

        $idUse = Auth::id();

        $misTickets = Ticket_hist::where('solicitante_id', $idUse)->get();

        $asignadosTickets = Ticket_hist::where('responsable_id', $idUse)->get();
    
        return view('historial',compact("misTickets", "asignadosTickets"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function histDetalleMisTickets($id)
    {
        $misTickets = Ticket_hist::where('id_ticket', $id);


    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
