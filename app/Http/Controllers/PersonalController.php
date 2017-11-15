<?php

namespace App\Http\Controllers;

use App\Personal;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path = 'personal';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $personals =  DB::table('personals')
        //                   ->get();
        $users = DB::table('users')->get();
        $cantPersonals = 1;
        return view($this->path . '.index', compact('cantPersonals', 'users'));

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Personal $personal
     * @return \Illuminate\Http\Response
     */
    public function show(Personal $personal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Personal $personal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personal = Personal::findOrFail($id);
        $users = DB::table('users')
            ->select('id', 'email')
            ->get();
        return view($this->path . '.edit', compact('personal', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Personal $personal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $personal = Personal::findOrFail($id);
        $personal->nombres = $request->nombres;
        $personal->apellidos = $request->apellidos;
        $personal->dni = $request->dni;
        $personal->fechanacimiento = $request->fechanacimiento;
        $personal->telefono = $request->telefono;
        $personal->genero = $request->genero;
        $personal->direccion = $request->direccion;

        $personal->save();

        alert()->success('Personal modificado correctamente', 'Modificado');

        return redirect()->route('personalindex');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Personal $personal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $personal = Personal::findOrFail($id);
            $personal->delete();

            alert()->error('Personal eliminado correctamente', 'Eliminado');

            return redirect()->route('personalindex');
        } catch (Exception $e) {
            return "Fatal error - " . $e->getMessage();
        }
    }
}
