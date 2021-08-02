<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Incluye;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Producto::with('incluyes')->with('rubro')->get();
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
        $producto = new Producto;
        $producto->nombre=$request->nombre;
        $producto->descripcion=$request->descripcion;
        $producto->precio=$request->precio;
        $producto->tipo=$request->tipo;
        $producto->imagen=$request->imagen;
        $producto->rubro_id=$request->rubro_id;
        $producto->save();

        foreach ($request->detalle as $k ) {
            $incluye = new Incluye;
            $incluye->nombre=$k['nombre'];
            $incluye->producto_id=$producto->id;
            $incluye->save();

        }
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
        return Producto::with('incluyes')->with('rubro')->where('id',$producto->$id)->get();

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        //
        $producto = Producto::find($producto->id);
        $producto->nombre=$request->nombre;
        $producto->descripcion=$request->descripcion;
        $producto->precio=$request->precio;
        $producto->tipo=$request->tipo;
        $producto->rubro_id=$request->rubro_id;
        $producto->save();

        DB::table('incluyes')->where('producto_id',$producto->id)->delete();
        foreach ($request->detalle as $k ) {
            $incluye = new Incluye;
            $incluye->nombre=$k['nombre'];
            $incluye->producto_id=$producto->id;
            $incluye->save();

        }
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
        DB::table('incluyes')->where('producto_id',$producto->id)->delete();
        return DB::table('productos')->where('id',$producto->id)->delete();
    }
}
