<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Client;

class ClientController extends Controller
{
    /**
     * Mostra uma lista com todos os clientes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Client::all()->toArray(),200);
    }   
    /**
     * Armazena em um json todas as clientes existentes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Client = Client::create($request->all());
        return response()->json($Client, 201);
    }
    /**
     * Exibe um cliente existente
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Client = Client::find($id);
        if($Client){
            return response()->json( $Client, 200);
        }else{
            return response()->json( ['message'  => 'Not Found'], 404);
        }
    }
    public static function getByDescription($description)
    {
        $Client = Client::where('description', $description)->first();
        if($Client){
            return $Client;
        }else{
            return Client::create(['description' => $description]);
        }
    }
    /**
     * Atualiza clientes de acordo com arquivo armazenado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Client= Client::find($id);
        $Client->update($request->all());
        return response()->json($Client, 201);
    }
    /**
     * Remove um cliente na base
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::find($id)->delete();
    }
}
