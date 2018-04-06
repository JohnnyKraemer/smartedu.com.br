<?php

use Illuminate\Database\Seeder;
use App\User;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'Coordenador Pato Branco',
            'email' => 'patobranco@coordenador.com.br',
            'password' => bcrypt('111111'),
            'status' => 1,
            'position_id' => 4,
            'campus_id' => 5,
        ]);

        User::create([
            'name' => 'Coordenador Curitiba',
            'email' => 'curitiba@coordenador.com.br',
            'password' => bcrypt('111111'),
            'status' => 1,
            'position_id' => 4,
            'campus_id' => 1,
        ]);

        User::create([
            'name' => 'Administrador Pato Branco',
            'email' => 'patobranco@administrador.com.br',
            'password' => bcrypt('111111'),
            'status' => 1,
            'position_id' => 3,
            'campus_id' => 5,
        ]);

        User::create([
            'name' => 'Administrador Curitiba',
            'email' => 'curitiba@administrador.com.br',
            'password' => bcrypt('111111'),
            'status' => 1,
            'position_id' => 3,
            'campus_id' => 1,
        ]);

        User::create([
            'name' => 'Administrador Instituição',
            'email' => 'instituicao@administrador.com.br',
            'password' => bcrypt('111111'),
            'status' => 1,
            'position_id' => 2,
        ]);
    }
}
