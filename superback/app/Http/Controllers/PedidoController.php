<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Detalle;
use App\Models\Pedido;
use App\Models\Subdetalle;
use Illuminate\Http\Request;

class PedidoController extends Controller
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
//        return $request->total;
        $cliente=Cliente::find($request->cliente['id']);
        $cliente->cinit=$request->cliente['cinit'];
        $cliente->nombre=$request->cliente['nombre'];
        $cliente->telefono=$request->cliente['telefono'];
        $cliente->direccion=$request->cliente['direccion'];
        $cliente->lat=$request->cliente['lat'];
        $cliente->lng=$request->cliente['lng'];
        $cliente->save();

        $pedido=new Pedido();
        $pedido->fecha=date('Y-m-d');
        $pedido->hora=date('H:i:s');
        $pedido->ci=$request->cliente['cinit'];
        $pedido->nombre=$request->cliente['nombre'];
        $pedido->direccion=$request->cliente['direccion'];
        $pedido->lat=$request->cliente['lat'];
        $pedido->lng=$request->cliente['lng'];
        $pedido->telefono=$request->cliente['telefono'];
        $pedido->factura=$request->cliente['cinit'];
        $pedido->total=$request->total;
        $pedido->user_id=$request->user()->id;
        $pedido->save();

        foreach ($request->detalles as $d){
            $detalle=new Detalle();
            $detalle->nombre=$d['nombre'];
            $detalle->precio=$d['precio'];
            $detalle->cantidad=$d['cantidad'];
            $detalle->subtotal=$d['subtotal'];
            $pedido->user_id=$request->user()->id;
            $detalle->agencia_id=$d['agencia_id'];
            $detalle->producto_id=$d['producto_id'];
            $detalle->pedido_id=$pedido->id;
            $detalle->save();
            foreach ($d['subdetalle'] as $s){
                $subdetalle= new Subdetalle();
                $subdetalle->nombre=$s['nombre'];
                $subdetalle->tipo=$s['tipo'];
                $subdetalle->cantidad=$s['cantidad'];
                $subdetalle->detalle_id=$detalle->id;
                $subdetalle->save();
            }
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
