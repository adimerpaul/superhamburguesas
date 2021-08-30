<?php

namespace App\Http\Controllers;

use App\Models\Rubro;
use Illuminate\Http\Request;

class RubroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Rubro::with('productos')->get();


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
    public function show(Request $request)
    {
        //
        return Rubro::leftJoin('productos','productos.rubro_id','=','rubro.id')
        ->where('productos.agencia',$request->id)->get();


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
