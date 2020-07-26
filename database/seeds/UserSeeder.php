<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
                'type' => 'default',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
                'api_token' => Str::random(80),
            ]);
        }

        //usuario especial para testear la api
        DB::table('users')->insert([
            'name' => 'api',
            'email' => 'api@gmail.com',
            'password' => Hash::make('api'),
            'type' => 'default',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
            'api_token' => Str::random(80),
        ]);

        //creo un usuario administrador
        DB::table('users')->insert([
            'name' => 'administrador',
            'email' => 'administrador@gmail.com',
            'password' => Hash::make('adminadmin'),
            'type' => 'admin',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
            'api_token' => Str::random(80)
        ]);

        DB::table('users')->insert([
            'name' => 'DungeonMaster',
            'email' => 'joaquintricerri@gmail.com',
            'password' => Hash::make('test1test1'),
            'type' => 'admin',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
            'api_token' => Str::random(80)
        ]);
    }
}
