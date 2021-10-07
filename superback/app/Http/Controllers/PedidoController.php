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
        return Pedido::with('detalles')->whereDate('fecha',now())->get();
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
            $detalle->peticion=$d['peticion'];
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

    public function printpedido($id){
        $pedido=Pedido::with('detalles')->where('id',$id)->get();
        // $cadena = '
        //     <style>.margen{padding: 0px 15px 0px 15px;}
        //     .textoimp{ font-size: small; text-align: center;}
        //     .textor{ font-size: small; text-align: right;}
        //     .textmed{ font-size: small; text-align: left;}
        //     table{border: 0px solid #000; text-align:center; align:center; width: 100% }
        //     th,td{font-size: small;}
        //     hr{border: 1px dashed ;}</style>
        //     <div class="textoimp margen">
        //     <span>'.$sale->dosage->empresa->nombre.'</span><br>
        //     <span>'.$sale->dosage->empresa->direccion.'</span><br>
        //     <span>Tel: '.$sale->dosage->empresa->telefono.'</span><br>
        //     <span>ORURO - BOLIVIA</span><br>
        //     <hr>
        //     <span>COMANDA #'.$comanda.'</span><br>
        //     <hr>';

        // $cadena.='<div class="textmed">Fecha hora: '.$sale->created_at.'<br><hr></div>';
        // $cadena.='<div class="textmed">Usuario: '.$sale->user->name.'<br><hr></div>';
        // $cadena.='<table><thead><tr>
        //         <th>DESC</th>              <th>CANT</th>     <th>P.U.</th>           <th>IMP</th><tr></thead>
        //         <tbody>';
        // $details=Detail::where('sale_id',$sale->id)->get();
        // foreach ($details as $row){
        //     $nombrep=$row->nombreproducto;
        //     $precio=$row->precio;
        //     $cantidad=$row->cantidad;
        //     $subtotal=$row->subtotal;
        //     $cadena.="<tr><td>$nombrep</td><td>$cantidad</td><td>$precio</td><td>$subtotal</td></tr>";

        // }
        // $cadena.="</tbody></table>";

        // $total=number_format($sale->total,2);

        // $d = explode('.',$total);
        // $entero=$d[0];
        // $decimal=$d[1];
        // $formatter = new NumeroALetras();

        // $cadena.=("<div class='textor'>SUBTOTAL: $sale->total Bs.<br>");
        // $cadena.=("TOTAL: $sale->total Bs.</div>");

        // $entero=str_replace(',','',$entero);
        // $cadena.="<div class='textmed'>SON: ".$formatter->toWords($entero)." $decimal/100 Bolivianos</div>
        // <hr>";
        // $user=User::where('id',$sale->user_id)->firstOrFail();
        // $cadena.='<div class="textmed"> <span> PUNTO: '.gethostname().'</span></div>';
        // $cadena.='<div class="textmed"> <span> NUMERO: '.$sale->id.'</span></div>';
        // return $cadena;
    }
}
