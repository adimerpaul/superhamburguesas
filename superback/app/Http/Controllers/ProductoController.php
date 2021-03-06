<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\IngredienteProducto;
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
        return Producto::with('incluyes')->with('rubro')->with('ingredientes')->with('agencia')->get();

        //return DB::table('productos')
        //->join('rubros','productos.rubro_id','=','rubros.id')
        //->join('incluyes','productos.incluye_id','=','incluyes.id')
        //->join('','productos._id','=','.id')

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
    public function crearproducto(Request $request){
        Producto::create($request->all());
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

        foreach ($request->ingrediente as $ing){
                DB::table('ingrediente_producto')->insert([
                'cantidad'=>$ing['cantidad'],
                'ingrediente_id'=>$ing['ingrediente_id'],
                'producto_id'=>$producto->id]);
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
        return Producto::with('incluyes')->with('rubro')->with('ingrediente')->where('id',$producto->$id)->get();

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

    public function upload(Request $request){
        $this->validate($request, [
            'imagen'=>'required'
        ]);
        if ($request->hasFile('imagen')) {
            $file=$request->file('imagen');
            $nombreArchivo = time().".".$file->getClientOriginalExtension();
            $file->move(\public_path('imagenes'), $nombreArchivo);
            return $nombreArchivo;
        }

    }
    public function update(Request $request, Producto $producto)
    {
        $producto->update($request->all());
        return $producto;
    }

    public function upincluye(Request $request)
    {
        //
        $producto = Producto::find($request->id);

        DB::table('incluyes')->where('producto_id',$producto->id)->delete();
        foreach ($request->detalle as $k ) {
            $incluye = new Incluye;
            $incluye->nombre=$k['nombre'];
            $incluye->producto_id=$producto->id;
            $incluye->save();

        }
        return true;
    }

    public function upingrediente(Request $request)
    {
        //
        $producto = Producto::find($request->id);

        DB::table('ingrediente_producto')->where('producto_id',$producto->id)->delete();
        foreach ($request->ingrediente as $k ) {
            DB::table('ingrediente_producto')->insert([
            'cantidad'=>$k['cantidad'],
            'ingrediente_id'=>$k['ingrediente_id'],
            'producto_id'=>$producto->id]);
        }
        return true;
    }

    public function updateimg(Request $request, Producto $producto)
    {
        //
        $producto = Producto::find($producto->id);
        $producto->save();
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
    public function productadd(Request $request){

        $product=Producto::find($request->id);
        $product->stock+=$request->stock;
        return $product->save();
    }

    public function productsub(Request $request){


        $product=Producto::find($request->id);
        if($product->stock < $request->stock)
            $product->stock=0;
        else
            $product->stock-=$request->stock;
        return $product->save();
    }

    public function grupo($id)
    {
        //
        return Producto::where('rubro_id',$id)->get();

    }

    public function clonar(Request $request)
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

        foreach ($request->ingrediente as $ing){
            $ingredienteproducto=new Productoingrediente;
            $ingredienteproducto->ingrediente_id=$ing['ingrediente_id'];
            $ingredienteproducto->cantidad=$ing['cantidad'];
            $ingredienteproducto->producto_id=$producto->id;
            $ingredienteproducto->save();
        }

        return true;
    }

}
