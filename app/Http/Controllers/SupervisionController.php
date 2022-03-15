<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class SupervisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function __construct()
    {
        $this->middleware('can:users.home')->only('index','update');

    }
    public function index()
    {
    
        


        $idUse = Auth::id();
        $use = new User();
        $use = $use->where('id',$idUse)->first();
        $roles = $use->getRoleNames();
        if($roles[0] == 'Superusuario'){
            $supervision = new User();
        $supervision = $supervision->all();
        }
             if($roles[0] == 'Supervisor'){
                $supervision = DB::table('tickets')
             ->join('areas', function ($join){
                 $join->on('tickets.area_id', '=', 'areas.id');
                 })->join('users', function ($join){
                 $join->on('tickets.responsable_id', '=', 'users.id');
             })->select('users.*')->where('areas.id_supervisor_area',$use->id)->orWhere('users.supervisor_rectoria',$idUse)->get();
         
        }



        return view('supervision.index',compact('supervision','use'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
         $pendientes = Ticket::where('status_id', 1)->where('responsable_id', $request->supervisor)->get();

             $completados = Ticket::where('status_id', 2)
            ->where('responsable_id', $request->supervisor)->get();
            $cancelado = Ticket::where('status_id', 3)
            ->where('responsable_id', $request->supervisor)->get();
             $validacion = Ticket::where('status_id', 4)
            ->where('responsable_id', $request->supervisor)->get();
            $perdido = Ticket::where('status_id', 5)
            ->where('responsable_id', $request->supervisor)->get();

            return view('supervision.show',compact("pendientes", "completados", "cancelado", "validacion", "perdido"));

        
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
