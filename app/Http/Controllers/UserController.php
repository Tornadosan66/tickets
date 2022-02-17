<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use App\Models\Planteles;
use Spatie\Permission\Models\Role;
class UserController extends Controller
{



        public function __construct()
    {
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.edit')->only('edit','update');
        $this->middleware('can:users.create')->only('create','store');
        $this->middleware('can:users.destroy')->only('destroy');

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = new User();
        $usuarios = $usuarios->all();
        return view('users.index',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $planteles = Planteles::all();
        $areas = Area::all();

        return view('users.create',compact('roles','planteles','areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name =  $request->name;
        $user->email =  $request->email;
        $user->plantel_id =  $request->plantel;
        $user->area_id =  $request->area;
        $user->password = bcrypt($request->password);

        $user->save();

        $user->roles()->sync($request->rol);

        return redirect()->route('usuarios.index')->with('info','Se creo correctamente');
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
        $usuarios = User::findorfail($id);
        $roles = Role::all();
        $planteles = Planteles::all();
        $areas = Area::all();
    

        return view('users.edit',compact('usuarios','roles','planteles','areas'));
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
            $user = User::findorfail($id);
            $user->name =  $request->name;
            $user->email =  $request->email;
            $user->plantel_id =  $request->plantel;
            $user->area_id =  $request->area;
            if($request->password)
            {
                $user->password = bcrypt($request->password);
            }   

            $user->save();

            $user->roles()->sync($request->rol);

            
            return redirect()->route('usuarios.index')->with('info','Se Actualizo correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorfail($id)->delete();
        return redirect()->route('usuarios.index')->with('info','Se Elimino correctamente');
    }
}
