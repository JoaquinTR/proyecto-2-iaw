<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creo 10 usuarios invitados
        foreach (range(0, 10) as $id) {
            DB::table('users')->insert([
                'name' => 'invitado'.$id,
                'email' => 'invitado'.$id.'@gmail.com',
                'password' => Hash::make('invitado'.$id.'invitado'.$id),
                'type' => 'default'
            ]);
        }

        //creo un usuario administrador
        DB::table('users')->insert([
            'name' => 'administrador',
            'email' => 'administrador@gmail.com',
            'password' => Hash::make('adminadmin'),
            'type' => 'admin'
        ]);

        DB::table('users')->insert([
            'name' => 'jefecito',
            'email' => 'joaquintricerri@gmail.com',
            'password' => Hash::make('test1test1'),
            'type' => 'admin'
        ]);
    }
}
