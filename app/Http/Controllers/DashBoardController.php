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
use App\Mail\EmergencyCallReceived;
use Mail;
use App\Models\Tareas;

class DashBoardController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:planteles.index')->only('terminar_ticket');

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
                $pendientes = DB::table('tickets')
             ->join('areas', function ($join){
                 $join->on('tickets.area_id', '=', 'areas.id');
                 })->join('users', function ($join){
                 $join->on('tickets.responsable_id', '=', 'users.id');
             })->select('tickets.*','users.email')->where('areas.id_supervisor_area',$use->id)->orWhere('users.supervisor_rectoria',$idUse)->where('status_id',1)->get();


      

        }else if($roles[0] == 'Superusuario'){
            $pendientes = Ticket::where('status_id', 1)->get();
        }
        
        if($roles[0] == 'Usuario'){
            $completados = Ticket::where('status_id', 2)
            ->where('responsable_id', $use->id)->get();
        }else if($roles[0] == 'Supervisor'){
            $completados = DB::table('tickets')
             ->join('areas', function ($join){
                 $join->on('tickets.area_id', '=', 'areas.id');
                 })->join('users', function ($join){
                 $join->on('tickets.responsable_id', '=', 'users.id');
             })->select('tickets.*','users.email')->where('areas.id_supervisor_area',$use->id)->orWhere('users.supervisor_rectoria',$idUse)->where('status_id',2)->get();
        }else if($roles[0] == 'Superusuario'){
            $completados = Ticket::where('status_id', 2)->get();
        }

        if($roles[0] == 'Usuario'){
             $cancelado = Ticket::where('status_id', 3)
            ->where('responsable_id', $use->id)->get();
        }else if($roles[0] == 'Supervisor'){
            $cancelado = DB::table('tickets')
             ->join('areas', function ($join){
                 $join->on('tickets.area_id', '=', 'areas.id');
                 })->join('users', function ($join){
                 $join->on('tickets.responsable_id', '=', 'users.id');
             })->select('tickets.*','users.email')->where('areas.id_supervisor_area',$use->id)->orWhere('users.supervisor_rectoria',$idUse)->where('status_id',3)->get();
        }else if($roles[0] == 'Superusuario'){
            $cancelado = Ticket::where('status_id', 3)->get();
        }

        if($roles[0] == 'Usuario'){
            $validacion = Ticket::where('status_id', 4)
            ->where('responsable_id', $use->id)->get();
        }else if($roles[0] == 'Supervisor'){
            $validacion = DB::table('tickets')
             ->join('areas', function ($join){
                 $join->on('tickets.area_id', '=', 'areas.id');
                 })->join('users', function ($join){
                 $join->on('tickets.responsable_id', '=', 'users.id');
             })->select('tickets.*','users.email')->where('areas.id_supervisor_area',$use->id)->orWhere('users.supervisor_rectoria',$idUse)->where('status_id',4)->get();
        }else if($roles[0] == 'Superusuario'){
            $validacion = Ticket::where('status_id', 4)->get();
        }

        if($roles[0] == 'Usuario'){
            $perdido = Ticket::where('status_id', 5)
            ->where('responsable_id', $use->id)->get();
        }else if($roles[0] == 'Supervisor'){
            $perdido = DB::table('tickets')
             ->join('areas', function ($join){
                 $join->on('tickets.area_id', '=', 'areas.id');
                 })->join('users', function ($join){
                 $join->on('tickets.responsable_id', '=', 'users.id');
             })->select('tickets.*','users.email')->where('areas.id_supervisor_area',$use->id)->orWhere('users.supervisor_rectoria',$idUse)->where('status_id',5)->get();
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

    public function re_asignar_ticket(Request $request)
    {
        $planteles = Planteles::all();
        $areas = Area::all();
        $usuarios = User::all();
        $ticket = Ticket::findorfail($request->id_reasignar)->first();

        return view('Dash.reasignar', compact("planteles", "areas", "usuarios", "ticket"));
    }

    public function terminar_ticket(Request $request)
    {

        $ticket = Ticket::findorfail($request->id_ticket2);

        if($request->status == 1){
            $ticket->status_id = 3;

            

        }else if($request->status == 2){
            $ticket->status_id = 1;
            $ticket->tiempo_realizar = 1440;

            

            $tic = tickets_completados::where('ticket_id',$request->id_ticket2)->first();
            $public_path = public_path();
            $nombre = $tic->evidencia;
            $url = $public_path.'/storage/'.$nombre;
            \Storage::disk('public')->delete($nombre);

            $tic->delete();

        }else if($request->status == 3){
            $ticket->status_id = 2;

            

        }
        $ticket->save();
        return redirect()->route('dashboard');

    }

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
        $ticket->tiempo_realizar = 1440;
        $ticket->tarea_id = $request->tareas;

        $ticket->save();    

        $ticket->setAttribute('name',$ticket->responsable->name);
        $ticket->setAttribute('solicitante',$ticket->solicitante->name);
         $mailable = new EmergencyCallReceived($ticket);
         $correos = [];
         $superVisorArea = Area::where('id',$ticket->area_id)->first();

         array_push($correos,$ticket->responsable->email,$superVisorArea->supervisor->email);
         //Mail::to($correos)->send($mailable);
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
        if($file){
            $nombre = 'ticket'.$ticket->id."-".$file->getClientOriginalName();

        $public_path = public_path();
        $url = $public_path.'/storage/'.$nombre;
        //dd($url);
        \Storage::disk('public')->put($nombre,  \File::get($file));
        $tic->evidencia = $nombre;
        }
        

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

        $ticket = Ticket::findorfail($id);
        tickets_completados::where('ticket_id', $ticket->id)->delete();
        $ticket->area_id = $request->area;
        $ticket->responsable_id = $request->Usuarios;
        $ticket->tiempo_realizar = 1440;
        $ticket->status_id = 1;

        $ticket->save();

        $ticket->setAttribute('name',$ticket->responsable->name);
        $ticket->setAttribute('solicitante',$ticket->solicitante->name);
         $mailable = new EmergencyCallReceived($ticket);
         $correos = [];
         $superVisorArea = Area::where('id',$ticket->area_id)->first();

         array_push($correos,$ticket->responsable->email,$superVisorArea->supervisor->email);
         Mail::to($correos)->send($mailable);

        return redirect()->route('dashboard')->with('info','Se re-asigno, una disculpa');
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


     public function tareas($tareas)
    {
        $tareas = Tareas::where("id_area",$tareas)->get();
        
        return response()->json($tareas->toArray());
    }   


     public function consulta_ticket($ticket)
    {

        $ticket = Ticket::where("id",$ticket)->first();
        $test = tickets_completados::where('ticket_id',$ticket->id)->first();
        $tarea = Tareas::where('id',$ticket->tarea_id)->first();
        $ticket->setAttribute('correo',$ticket->solicitante->name);
         
        if($test)
        {
            $ticket->setAttribute('evidencia',$test->evidencia);
            $ticket->setAttribute('descripcionCompletada',$test->descripcion);  
        }
        if($tarea)
        {
            $ticket->setAttribute('tarea',$tarea->tarea);
        }        

        

        
        return response()->json($ticket->toArray());
    }


    public function actualizar()
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
        
        return response()->json($pendientes, 200);
    }   


}
