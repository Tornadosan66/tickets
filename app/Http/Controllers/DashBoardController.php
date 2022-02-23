<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use App\Models\Planteles;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\tickets_completados;

class DashBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('dashboard');
    }
    public function Panel()
    {
        $idUse = Auth::id();
        $use = new User();
        $use = $use->where('id',$idUse)->first();

        $roles = $use->getRoleNames();

        if($roles[0] == 'Usuario'){
            $pendientes = Ticket::where('status_id', 1)
            ->where('responsable_id', $use->id)->get();
        }else if($roles[0] == 'Supervisor'){
            $pendientes = Ticket::where('status_id', 1)
            ->where('area_id', $use->area_id)->get();
        }else if($roles[0] == 'Superusuario'){
            $pendientes = Ticket::where('status_id', 1)->get();
        }
        
        if($roles[0] == 'Usuario'){
            $completados = Ticket::where('status_id', 2)
            ->where('responsable_id', $use->id)->get();
        }else if($roles[0] == 'Supervisor'){
            $completados = Ticket::where('status_id', 2)
            ->where('area_id', $use->area_id)->get();
        }else if($roles[0] == 'Superusuario'){
            $completados = Ticket::where('status_id', 2)->get();
        }

        if($roles[0] == 'Usuario'){
            $cancelado = Ticket::where('status_id', 3)
            ->where('responsable_id', $use->id)->get();
        }else if($roles[0] == 'Supervisor'){
            $cancelado = Ticket::where('status_id', 3)
            ->where('area_id', $use->area_id)->get();
        }else if($roles[0] == 'Superusuario'){
            $cancelado = Ticket::where('status_id', 3)->get();
        }

        return view('dashboard',compact("pendientes", "completados", "cancelado"));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $planteles = Planteles::all();
        $areas = Area::all();
        $usuarios = User::all();
        return view('Dash.Formulario', compact('planteles'), compact('areas'), compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ticket = new Ticket();
        $ticket->descripcion = $request->desc;
        $ticket->area_id = $request->area;
        $ticket->responsable_id = $request->Usuarios;
        $ticket->solicitante_id = Auth::id();
        $ticket->fecha_envio = $request->fecha_envio;
        $ticket->status_id = "1";
        $ticket->tiempo_realizar = $request->tiempo;

        $ticket->save();

        return redirect()->route('dashboard')->with('info','se hizo el ticket');
    }

    public function terminar(Request $request){

        $ticket = Ticket::findorfail($request->id_ticket);
        $ticket->fecha_completada = date("Y-m-d");
        $ticket->status_id = 4;

        $ticket->save();

        $tic = new tickets_completados();
        $tic->descripcion = $request->desc2;
        $tic->ticket_id = $ticket->id;
        $file = $request->file('file');
        $nombre = $file->getClientOriginalName();
        \Storage::disk('public')->put($nombre,  \File::get($file));

        $tic->save();

        return redirect()->route('dashboard')->with('info','se reviso el ticket');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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

    public function consulta_areas($area)
    {
        $area = Area::where("id_plantel",$area)->get();
        
        return response()->json($area->toArray());
    }
    public function usuarios($usuarios)
    {
        $user = User::where("area_id",$usuarios)->get();
        
        return response()->json($user->toArray());
    }   

     public function consulta_ticket($ticket)
    {
        $ticket = Ticket::where("id",$ticket)->first();
        $ticket->setAttribute('correo',$ticket->solicitante->name);    
     
        
        return response()->json($ticket->toArray());
    }
}
