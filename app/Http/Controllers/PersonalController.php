<?php

namespace App\Http\Controllers;

use App\Personal;
use App\User;
use Illuminate\Http\Request;

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
        try {
            $personals = Personal::all();
            $users = User::all();
            $cantPersonals = Personal::get()->count();
            return view($this->path . '.index', compact('personals', 'users', 'cantPersonals'));
        } catch (Exception $e) {
            alert()->error('Ha ocurrido un error: ' . $e->getMessage(), 'Error');
        }
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
        return view($this->path . '.edit', compact('personal'));
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

        alert()->success('Personal modificado correctamente', 'Modificado' );

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
