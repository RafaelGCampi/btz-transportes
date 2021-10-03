<?php

namespace App\Http\Controllers;

use App\Models\Abastecimento;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbastecimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('telas.abastecimento');
    }

   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'veiculo_id'=>'required',
            'motorista_id'=>'required',
            'data'=>'required|date',
            //não deixar adicionar valores com zero
            'quantidade_abastecida'=>'required|numeric|gt:0',
            'tipo_combustivel_id'=>'required',
        ]);

        $data = $request->all();
        try {
            DB::beginTransaction();

            $abastecimento= Abastecimento::create($data);

            DB::commit();
            return response()->json(['message' => 'true','abastecimento'=>$abastecimento]);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'false', 'error' => $exception->getMessage()],422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Abastecimento  $abastecimento
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('componentes.Abastecimento.core');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Abastecimento  $abastecimento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $abastecimento = Abastecimento::with('veiculo','motorista')->find((int) $id);
        return response($abastecimento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Abastecimento  $abastecimento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Abastecimento $abastecimento)
    {
        try {
            DB::beginTransaction();
            $abastecimento->delete();
            DB::commit();
            return response()->json(['message' => 'true']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => 'false', 'error' => $exception]);
        }
    }

    public function list()
    {
        $abastecimentos = Abastecimento::with('veiculo','motorista','combustivel')->get();
        return response($abastecimentos);
    }
}
