<?php

namespace App\Http\Controllers;

use App\Models\Grupoingrediente;
use Illuminate\Http\Request;

class GrupoingredienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Grupoingrediente::all();
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
     * @param  \App\Models\Grupoingrediente  $grupoingrediente
     * @return \Illuminate\Http\Response
     */
    public function show(Grupoingrediente $grupoingrediente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grupoingrediente  $grupoingrediente
     * @return \Illuminate\Http\Response
     */
    public function edit(Grupoingrediente $grupoingrediente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grupoingrediente  $grupoingrediente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grupoingrediente $grupoingrediente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grupoingrediente  $grupoingrediente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grupoingrediente $grupoingrediente)
    {
        //
    }
}
