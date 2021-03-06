<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Rubro;
use Illuminate\Http\Request;

class RubroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        return $request;
        return Rubro::with('productos')->get();

    }
    public function rubroproductos(Rubro $rubro)
    {
//        return $request;
//        return Rubro::with('productos')->get();
        return $rubro->with('productos')->get();

    }
    public function misproductos(Request $request){
        $agencia_id=$request->agencia_id;
//        return $agencia_id;
        return Rubro::with(['productos'=>function($query) use ($agencia_id) {
            $query->where('agencia_id',$agencia_id)->where('mostrar',true);
        }])->get();
    }

    public function misproductosrubros($rubro_id){
        return Producto::where('rubro_id',$rubro_id)->with('ingredientes')->with('incluyes')->with('combos')->with('subproductos')->get();
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
    public function upload5(Request $request){
        $this->validate($request, [
            'imagen'=>'required'
        ]);
        if ($request->hasFile('imagen')) {
            $file=$request->file('imagen');
            $nombreArchivo = time().".".$file->getClientOriginalExtension();
            $file->move(\public_path('imagenes'), $nombreArchivo);

            $producto=Producto::find($request->id);
            $producto->imagen=$nombreArchivo;
            $producto->save();
//            return $nombreArchivo;
        }
    }


    public function store(Request $request)
    {
        //
        $input=$request->all();
        $rubro=Rubro::create($input);
        return $rubro;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        return $id;
//        return Rubro::leftJoin('productos','productos.rubro_id','=','rubro.id')
//        ->where('productos.agencia',$request->id)->get();
        $dato=$id;
        return Rubro::with(['productos'=>function($query) use ( $dato ){
            $query->where('agencia_id', $dato);
        }])->get();
//        return Rubro::with('productos')->where('agencia_id',$id)->get();
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function edit(Rubro $rubro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rubro $rubro)
    {
        //
        $rubro->update($request->all());
        return $rubro;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $rubro=Rubro::find($id);
        $rubro->delete();
        return response()->json(['res'=>'Borrado exitoso'],200);
    }
}
