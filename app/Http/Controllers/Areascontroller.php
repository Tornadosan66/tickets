<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planteles;
use App\Models\Area;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Areascontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = new Area();
        $areas = $areas->all();
        return view('areas.index',compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $usuarios = DB::table('users')->join('model_has_roles','model_id' ,'=', 'users.id')->select('users.id', 'users.name')->where('model_has_roles.role_id', '<', 3)->get();
        $planteles = new Planteles();
        $planteles = $planteles->all();
        
        return view('areas.create', compact('planteles','usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $area = new Area();
        $area->nombre_area =  $request->name;
        $area->id_plantel =  $request->plantel;
        $area->id_supervisor_area =  $request->supervisor;
        $area->descripcion =  $request->desc;

        $area->save();

        return redirect()->route('areas.index')->with('info','Se creo correctamente');
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
        $usuarios = DB::table('users')->join('model_has_roles','model_id' ,'=', 'users.id')->select('users.id', 'users.name')->where('model_has_roles.role_id', '<', 3)->get();
        $planteles = new Planteles();
        $planteles = $planteles->all();
        $areas = Area::findorfail($id);
        return view('areas.edit',compact('areas','usuarios','planteles'));
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
        $area = Area::findorfail($id);
        $area->nombre_area =  $request->name;
        $area->id_plantel =  $request->plantel;
        $area->id_supervisor_area = $request->supervisor;
        $area->descripcion =  $request->desc;

        $area->save();

        return redirect()->route('areas.index')->with('info','Se modofico el area');
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
