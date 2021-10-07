<?php

namespace App\Http\Controllers;

use App\Models\Incluye;
use Illuminate\Http\Request;

class IncluyeController extends Controller
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
        return Incluye::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incluye  $incluye
     * @return \Illuminate\Http\Response
     */
    public function show(Incluye $incluye)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incluye  $incluye
     * @return \Illuminate\Http\Response
     */
    public function edit(Incluye $incluye)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incluye  $incluye
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incluye $incluye)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incluye  $incluye
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incluye $incluye)
    {
        $incluye->delete();
    }
}
