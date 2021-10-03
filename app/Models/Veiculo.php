<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{

    protected $appends = ['quantidade_abastecida'];

    protected $fillable = [
        'nome',
        'placa',
        'tipo_combustivel_id',
        'fabricante',
        'ano_fabricacao',
        'capacidade_tanque'
    ];

    protected $casts = [
        'capacidade_tanque'=>'float',
        'tipo_combustivel_id'=>'integer'
    ];

    public function abastecimentos(){
        return $this->HasMany(Abastecimento::class);
    }

    public function getQuantidadeAbastecidaAttribute()
    {
        $quantidade=0;
        $this->abastecimentos()->get()->map(function($abastecimento) use(&$quantidade) {
            //dd($abastecimento->quantidade_abastecida);
            $quantidade += $abastecimento->quantidade_abastecida;
        });
        return $quantidade;
    }

}
