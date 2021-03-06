<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use App\Models\Planteles;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $idUse = Auth::id();

        $use = new User();
        $use = $use->where('id',$idUse)->first();



        $roles = $use->getRoleNames(); 
        //$nombres = $use->gethostname();
        //dd($nombres);

        if($roles[0] == 'Superusuario'){
            //dd($roles);
            $usuarios = new User();
            $usuarios = $usuarios->all();
        }else if($roles[0] == 'Supervisor'){
            $usuarios = new User();
            if($use->plantel_id == 1){
                $usuarios = $usuarios->where('plantel_id',$use->plantel_id)->where('area_id',$use->area_id)->get();    
            }
            else
            {
                $usuarios = $usuarios->where('plantel_id',$use->plantel_id)->get();    
            }
            
        }
        
        return view('users.index',compact('usuarios'));
        
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
            $rol = $use->getRoleNames();
            $roles = Role::all();
            $planteles = Planteles::all();
            $usuarios = DB::table('users')->join('model_has_roles','model_id' ,'=', 'users.id')->select('users.id', 'users.name')->whereNull('deleted_at')->where('model_has_roles.role_id', '<', 3)->get();

        if($rol[0] == 'Superusuario'){
            $areas = Area::all();
        }else if($rol[0] == 'Supervisor'){
            if($use->plantel_id == 1){
            
                $areas = Area::where('id', $use->area_id)->get();
            }
            else
            {
                $areas = Area::where('id_plantel', $use->plantel_id)->get();    
            }
            
            //dd($areas);
        }

        return view('users.create',compact('roles','planteles','areas','usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $idUse = Auth::id();
        $use = new User();
        $use = $use->where('id',$idUse)->first();
        $roles = $use->getRoleNames();
        if($roles[0] == 'Superusuario'){
            $user = new User();
            $user->name =  $request->name;
            $user->email =  $request->email;
            $user->plantel_id =  $request->plantel;
            $user->area_id =  $request->area;
            $user->supervisor_rectoria =  $request->supervisorRectoria;
            $user->password = bcrypt($request->password);

            $user->save();
            $user->roles()->sync($request->rol);
        }else if($roles[0] == 'Supervisor'){
            $user = new User();
            $user->name =  $request->name;
            $user->email =  $request->email;
            $user->plantel_id = $use->plantel_id;
            $user->area_id = $request->area;
            $user->supervisor_rectoria =  $request->supervisorRectoria;
            $user->password = bcrypt($request->password);

            $user->save();
            $user->roles()->sync(3);
        }


        

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
        $idUse = Auth::id();
        $use = new User();
        $use = $use->where('id',$idUse)->first();
        $rol = $use->getRoleNames();
        $supervisores = DB::table('users')->join('model_has_roles','model_id' ,'=', 'users.id')->select('users.id', 'users.name')->whereNull('deleted_at')->where('model_has_roles.role_id', '<', 3)->get();

    
        if($rol[0] == 'Superusuario'){
            $areas = Area::all();
        }else if($rol[0] == 'Supervisor'){
            if($use->plantel_id == 1){
                $areas = Area::where('id', $use->area_id)->get();
            }else{
                $areas = Area::where('id_plantel', $use->plantel_id)->get();
            }
            
            //dd($areas);
        }

        return view('users.edit',compact('usuarios','roles','planteles','areas','supervisores'));
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
            
            $user->area_id =  $request->area;
            if($request->password)
            {
                $user->password = bcrypt($request->password);
            }
            if($request->plantel){
                $user->plantel_id =  $request->plantel;
            }
            if($request->rol){
                $user->roles()->sync($request->rol);
            }
            if($request->supervisorRectoria)
            {
                $user->supervisor_rectoria =  $request->supervisorRectoria;    
            }
            

            $user->save();

            

            
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
