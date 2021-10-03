<?php

namespace Database\Seeders;

use App\Models\TipoCombustivel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' =>'admin@btz.com',
            'password' => Hash::make('btz123456')
        ]);

        $tipo_combustiveis=[
            array(
                'nome' => 'Gasolina',
                'preco'=>4.29,
            ),
            array(
                'nome' => 'Etanol',
                'preco'=>2.99,
            ),
            array(
                'nome' => 'Diesel',
                'preco'=>2.09,
            ),
        ];
        foreach($tipo_combustiveis as $tipo_combustivel ){
            TipoCombustivel::updateOrCreate(
                $tipo_combustivel
            );
        }
    }
}
