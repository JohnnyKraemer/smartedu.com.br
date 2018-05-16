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
            'name' => 'Administrador Instituição',
            'email' => 'administrador@instituicao.com.br',
            'password' => bcrypt('111111'),
            'status' => 1,
            'position_id' => 2,
        ]);

        User::create([
            'name' => 'Administrador Pato Branco',
            'email' => 'administrador@patobranco.com.br',
            'password' => bcrypt('111111'),
            'status' => 1,
            'position_id' => 3,
            'campus_id' => 1,
        ]);

        User::create([
            'name' => 'Administrador Curitiba',
            'email' => 'administrador@curitiba.com.br',
            'password' => bcrypt('111111'),
            'status' => 1,
            'position_id' => 3,
            'campus_id' => 3,
        ]);

        User::create([
            'name' => 'Coordenador Pato Branco',
            'email' => 'coordenador@patobranco.com.br',
            'password' => bcrypt('111111'),
            'status' => 1,
            'position_id' => 4,
            'campus_id' => 1,
        ]);

        User::create([
            'name' => 'Coordenador Curitiba',
            'email' => 'coordenador@curitiba.com.br',
            'password' => bcrypt('111111'),
            'status' => 1,
            'position_id' => 4,
            'campus_id' => 3,
        ]);

        User::create([
            'name' => 'Professor Pato Branco',
            'email' => 'professor@patobranco.com.br',
            'password' => bcrypt('111111'),
            'status' => 1,
            'position_id' => 5,
            'campus_id' => 1,
        ]);

        User::create([
            'name' => 'Professor Curitiba',
            'email' => 'professor@curitiba.com.br',
            'password' => bcrypt('111111'),
            'status' => 1,
            'position_id' => 5,
            'campus_id' => 3,
        ]);

    }
}
