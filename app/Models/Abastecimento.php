<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class Abastecimento extends Model
{
    protected $fillable = [
        'data',
        'tipo_combustivel_id',
        'quantidade_abastecida',
        'veiculo_id',
        'motorista_id'
    ];

    protected $casts = [
        'data'=>'date',
        'tipo_combustivel_id'=>'integer'
    ];


    public function setQuantidadeAbastecidaAttribute($value)
    {
        if ( ($value + $this->veiculo->quantidade_abastecida) > $this->veiculo->capacidade_tanque){
            throw new ModelNotFoundException('Não é possivel abastecer pois o tanque chegou ao seu máximo.');
        }
        return $this->attributes['quantidade_abastecida'] = $value;
    }

    public function setTipoCombustivelIdAttribute($value)
    {
        if ( $value != $this->veiculo->tipo_combustivel_id){
            throw new ModelNotFoundException('Tipo de combustível não é compativel com o veículo.');
        }
        return  $this->attributes['tipo_combustivel_id'] = $value;
    }

    public function veiculo(){
        return $this->HasOne(Veiculo::class,'id','veiculo_id');
    }

    public function motorista(){
        return $this->HasOne(Motorista::class,'id','motorista_id');
    }

    public function combustivel(){
        return $this->HasOne(TipoCombustivel::class,'id','tipo_combustivel_id');
    }
}
