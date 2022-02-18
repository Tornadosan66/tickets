<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planteles;


class PlantelesController extends Controller
{
       public function __construct()
    {
        $this->middleware('can:planteles.index')->only('index');
        $this->middleware('can:planteles.edit')->only('edit','update');
        $this->middleware('can:planteles.create')->only('create','store');
        $this->middleware('can:planteles.destroy')->only('destroy');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $planteles = new Planteles();
        $planteles = $planteles->all();
        return view('planteles.index',compact('planteles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('planteles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $plantel = new Planteles();
        $plantel->nombre_plantel =  $request->name;

        $plantel->save();

        return redirect()->route('planteles.index')->with('info','Se creo correctamente');
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
        $planteles = Planteles::findorfail($id);
        return view('planteles.edit',compact('planteles'));
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
        $planteles = Planteles::findorfail($id);
        $planteles->nombre_plantel =  $request->name;

        $planteles->save();

        return redirect()->route('planteles.index')->with('info','Se modofico el nombre');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $planteles = Planteles::findorfail($id)->delete();
        return redirect()->route('planteles.index')->with('info','Se elimino');
    }
}
