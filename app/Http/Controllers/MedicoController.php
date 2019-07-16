<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('painel.medicos');

    }

    public function listar(){
        return \App\Medico::all();

    }

    public function salvar(Request $request)
    {
        $medicoRequest = (object) $request;
        if($medicoRequest->id){
            return $this->update($medicoRequest);
        }else{
            return $this->store($medicoRequest); 
        }
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
    public function store($medicoRequest)
    {
        $medico = new \App\Medico;
        $medico->nome = $medicoRequest->nome;
        $medico->valor = $medicoRequest->valor;
        $medico->especialidade = $medicoRequest->especialidade;
        $medico->save();
        return "Médico ". $medico->nome." adicionado";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($medicoRequest)
    {
        $medico = \App\Medico::find($medicoRequest->id);
        $medico->nome = $medicoRequest->nome;
        $medico->valor = $medicoRequest->valor;
        $medico->especialidade = $medicoRequest->especialidade;
        $medico->save();
        return "Médico ".$medico->nome." foi alterado";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medico = \App\Medico::find($id);
        $nome = $medico->nome;
        $medico->delete();
        return "Médico ".$nome." foi deletado da base";
    }
}
