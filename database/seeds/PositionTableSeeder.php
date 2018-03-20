<?php

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::getQuery()->delete();

        Position::create([
            'name' => 'Desenvolvedor',
            'description' => 'Desenvolvedor do Sistema',
        ]);

        Position::create([
            'name' => 'Coordenador',
            'description' => 'Coordenador de Curso',
        ]);

        Position::create([
            'name' => 'Administrador do Campus',
            'description' => 'Administrador do Campus',
        ]);

        Position::create([
            'name' => 'Administrador da Instituição',
            'description' => 'Administrador da Instituição',
        ]);
    }
}
