<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path = 'producto';
    public function index()
    {
        try{
            $data = DB::table('productos')
                        ->orderBy('id')
                        ->get();

            $numProductos = Producto::get()->count();

            return view($this->path . '.index', compact('data', 'numProductos'));
        }catch(Exception $e){
            alert()->error('Ha ocurrido un error: ' . $e->getMessage(), 'Error' );
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
          $producto = new Producto();
          $producto->nombre = $request->nombre;
          $producto->descripcion = $request->descripcion;
          $producto->precio = $request->precio;
          $producto->save();

          alert()->success('Producto agregado correctamente', 'Agregado' );

          return redirect()->route('productoindex');
        }catch(Exception $e){
            return "Fatal error - " . $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);

        return view($this->path.'.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->save();

        alert()->success('Producto editado correctamente', 'Modificado' );

        return redirect()->route('productoindex');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
          $producto = Producto::findOrFail($id);
          $producto->delete();

          alert()->error('Producto eliminado correctamente', 'Eliminado' );

          return redirect()->route('productoindex');
        }catch(Exception $e){
          return "Fatal error - ". $e->getMessage();
        }
    }
}
