<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VeiculoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('telas.veiculo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->all());
        $data = $request->validate([
            'nome'=>'required',
            'placa'=>'required',
            'tipo_combustivel'=>'required',
            'fabricante'=>'required',
            'ano_fabricacao'=>'required',
            'capacidade_tanque'=>'required'
        ]);

        try {
            DB::beginTransaction();
            if(empty($request->id )) {
                $veiculo= Veiculo::create($data);
            }
            else{
                $veiculo =  Veiculo::find((int)$request->id);
                $veiculo->update($data);
            }
            DB::commit();
            return response()->json(['message' => 'true']);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'false', 'error' => $exception->getMessage()],402);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Veiculo  $veiculo
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('componentes.veiculo.core');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Veiculo  $veiculo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $veiculo = Veiculo::find((int) $id);
        return response($veiculo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Veiculo  $veiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Veiculo $veiculo)
    {
        try {
            DB::beginTransaction();
            $veiculo->delete();
            DB::commit();
            return response()->json(['message' => 'true']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => 'false', 'error' => $exception]);
        }
    }

    public function list()
    {
        $veiculos = Veiculo::get();
        return response($veiculos);
    }
}
