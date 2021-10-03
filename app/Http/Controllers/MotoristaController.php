<?php

namespace App\Http\Controllers;

use App\Models\Motorista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;

class MotoristaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('telas.motorista');
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
            'nome'=>'required',
            'cpf'=>'required|cpf',
            'data_nascimento'=>'required',
            'numero_cnh'=>'required|cnh',
            'categoria_cnh'=>'required'
        ]);

        try {
            DB::beginTransaction();
            if(empty($request->id )) {
                $motorista= Motorista::create($data);
            }
            else{
                $motorista =  Motorista::find((int)$request->id);
                $motorista->update($data);
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
     * @param  \App\Models\Motorista  $motorista
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('componentes.motorista.core');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Motorista  $motorista
     * @return \Illuminate\Http\Response
     */
    public function edit(Motorista $motorista)
    {
        //$motorista = Motorista::find((int) $id);
        return response($motorista);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Motorista  $motorista
     * @return \Illuminate\Http\Response
     */
    public function destroy(Motorista $motorista)
    {
        try {
            DB::beginTransaction();
            $motorista->delete();
            DB::commit();
            return response()->json(['message' => 'true']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => 'false', 'error' => $exception]);
        }
    }

    public function list()
    {
        $motoristas = Motorista::get();
        return response($motoristas);
    }
}
