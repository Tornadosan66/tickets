<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tareas;
use App\Models\Area;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
class TareasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


           public function __construct()
    {
        $this->middleware('can:tareas.index')->only('index');
        $this->middleware('can:tareas.edit')->only('edit','update');
        $this->middleware('can:tareas.create')->only('create','store');
        $this->middleware('can:tareas.destroy')->only('destroy');

    }
    public function index()
    {
        
        $idUse = Auth::id();
        $use = new User();
        $use = $use->where('id',$idUse)->first();
        $roles = $use->getRoleNames();

        if($roles[0] == 'Superusuario'){
            $tareas = new Tareas();
            $tareas = $tareas->all();
        }
        else
        {
            $tareas = DB::table('tareas')
             ->join('areas', function ($join){
                 $join->on('tareas.id_area', '=', 'areas.id');
                 })->join('planteles', function ($join){
                 $join->on('areas.id_plantel', '=', 'planteles.id');
             })->select('tareas.*','areas.nombre_area')->where('areas.id_supervisor_area',$idUse)->get();
        }

        

        return view('tareas.index',compact('tareas'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idUse = Auth::id();
        $use = new User();
        $use = $use->where('id',$idUse)->first();
        if($use->plantel_id == 1)
        {
            $areas = Area::where('id',$use->area_id)->get();
        }else{
            $areas = Area::where('id_plantel',$use->plantel_id)->get();
        }
        


        return view('tareas.create',compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tarea = new Tareas();
        $tarea->tarea =  $request->tarea;
        $tarea->id_area=  $request->area;
        $tarea->id_user =  $request->Usuarios;

        $tarea->save();

        return redirect()->route('tareas.index')->with('info','Se creo correctamente');
        
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
     $tarea = Tareas::findorfail($id);
     $idUse = Auth::id();
     $use = new User();
     $use = $use->where('id',$idUse)->first();
     if($use->plantel_id == 1)
     {
        $areas = Area::where('id',$use->area_id)->get();
     }else{
        $areas = Area::where('id_plantel',$use->plantel_id)->get();
    }
     $usuarios = User::where('area_id',$use->area_id)->get();

     return view('tareas.edit',compact('tarea','areas','usuarios'));
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
        $tarea = Tareas::findorfail($id);
        $tarea->tarea =  $request->name;
        $tarea->id_area =  $request->area;
        $tarea->id_user = $request->Usuarios;

        $tarea->save();

        return redirect()->route('tareas.index')->with('info','Se modofico la tarea');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tarea = Tareas::findorfail($id)->delete();
        
    }
}
