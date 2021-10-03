<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motorista extends Model
{
    protected $fillable = [
        'nome',
        'cpf',
        'numero_cnh',
        'categoria_cnh',
        'data_nascimento'
    ];

    protected $casts = [
        'status'=>'boolean'
    ];

    protected static function booted()
    {
        static::addGlobalScope('apenas_ativos', function (Builder $builder) {
            //trazer apenas status ativo
            $builder->where('status',true);
        });
    }
    public function setCpfAttribute($value){
        //tirar traços antes de salvar no banco
        $remove=[".", "-"];
        $value= str_replace($remove,"",$value);
        $this->attributes['cpf']=$value;
    }

    public function getCpfAttribute(){
        $cpf = preg_replace("/\D/", '', $this->attributes['cpf']);

        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cpf);
    }
}
