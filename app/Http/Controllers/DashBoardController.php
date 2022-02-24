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
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:planteles.index')->only('terminar');

    }
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

        if($roles[0] == 'Usuario'){
            $validacion = Ticket::where('status_id', 4)
            ->where('responsable_id', $use->id)->get();
        }else if($roles[0] == 'Supervisor'){
            $validacion = Ticket::where('status_id', 4)
            ->where('area_id', $use->area_id)->get();
        }else if($roles[0] == 'Superusuario'){
            $validacion = Ticket::where('status_id', 4)->get();
        }

        if($roles[0] == 'Usuario'){
            $perdido = Ticket::where('status_id', 5)
            ->where('responsable_id', $use->id)->get();
        }else if($roles[0] == 'Supervisor'){
            $perdido = Ticket::where('status_id', 5)
            ->where('area_id', $use->area_id)->get();
        }else if($roles[0] == 'Superusuario'){
            $perdido = Ticket::where('status_id', 5)->get();
        }

        return view('dashboard',compact("pendientes", "completados", "cancelado", "validacion", "perdido"));
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
        return view('Dash.Formulario', compact('planteles', 'areas', 'usuarios'));
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

    public function mandarRevision(Request $request){

        $ticket = Ticket::findorfail($request->id_ticket);
        $ticket->fecha_completada = date("Y-m-d");
        $ticket->status_id = 4;

        $ticket->save();

        $tic = new tickets_completados();
        $tic->descripcion = $request->desc2;
        $tic->ticket_id = $ticket->id;
        $file = $request->file('file');
        $nombre = $file->getClientOriginalName();
        $public_path = public_path();
        $url = $public_path.'/storage/'.$nombre;
        //dd($url);
        \Storage::disk('public')->put($nombre,  \File::get($file));
        $tic->evidencia = $nombre;

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
        $ticket = tickets_completados::where('ticket_id', $id)->first();
        $public_path = public_path();
        $nombre = $ticket->evidencia;
        $url = $public_path.'/storage/'.$nombre;
        //dd($url);
        //if (\Storage::exists($url))
        //{
            return response()->download($url);
        //}
        //else
        //{
         //   echo "falle";
       // }

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
        $test = tickets_completados::where('ticket_id',$ticket->id)->first();
        $ticket->setAttribute('correo',$ticket->solicitante->name); 
        if($test)
        {
            $ticket->setAttribute('evidencia',$test->evidencia);
            $ticket->setAttribute('descripcionCompletada',$test->descripcion);  
        }
        

        

        
        return response()->json($ticket->toArray());
    }
}
