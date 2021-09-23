<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $combo=new Combo();
        $combo->producto_id=$request->producto_id;
        $combo->producto_id2=$request->producto_id2;
        $combo->tipo=$request->tipo;
        $combo->save();
        return $combo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DB::select("SELECT c.id,p2.nombre,c.tipo
FROM combos c
INNER JOIN productos p2 ON c.producto_id2=p2.id
WHERE producto_id=$id");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function edit(Combo $combo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Combo $combo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Combo $combo)
    {
        $combo->delete();
    }
}
