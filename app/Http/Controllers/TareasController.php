<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tareas;
use App\Models\Area;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class TareasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $tareas = new Tareas();
        $tareas = $tareas->all();
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
        $areas = Area::where('id_plantel',$use->plantel_id)->get();


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
     $areas = Area::where('id_plantel',$use->plantel_id)->get();
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
