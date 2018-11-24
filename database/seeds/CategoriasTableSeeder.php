<?php

use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Alimentacion',
            'Transporte',
            'Arriendo',
            'Energia Electrica',
            'Acueducto',
            'Internet',
            'Telefono',
            'Television',
            'Netflix',
            'Ropa'
        ];
        foreach ($names as $name ) {
            $categoria = \App\Categoria::create(['name' => $name]);
        }
    }
}
