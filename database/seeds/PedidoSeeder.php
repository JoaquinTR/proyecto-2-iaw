<?php

use Illuminate\Database\Seeder;

class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pedido')->insert([
            'nombre' => "Dragon Age: Origins",
            'users_id' => '12',
            'genero' => '["RPG"]',
            'fecha_lanzamiento' => "2009-11-03 12:00:00",
            'descripcion'=> "From the makers of Mass Effect, Star Wars: Knights of the Old Republic, and Baldur's Gate comes Dragon Age: Origins, an epic tale of violence, lust, and betrayal. The survival of humanity rests in the hands of those chosen by fate. You are a Grey Warden, one of the last of an ancient order of guardians who have defended the lands throughout the centuries. Betrayed by a trusted general in a critical battle, you must hunt down the traitor and bring him to justice. As you fight your way towards the final confrontation with an evil nemesis, you will face monstrous foes and engage in epic quests to unite the disparate peoples of a world at war. A romance with a seductive shapeshifter may hold the key to victory, or she may be a dangerous diversion from the heart of your mission. To be a leader, you must make ruthless decisions and be willing to sacrifice your friends and loved ones for the greater good of mankind.",
            'plataforma'=> '["PlayStation 3","PC","Xbox 360","Macintosh"]',
            'editor'=> '["Electronic Arts","Spike"]',
            'desarrollador'=> '["BioWare"]',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('pedido')->insert([
            'nombre' => "Vagrant Story",
            'users_id' => '12',
            'genero' => '["Action","RPG"]',
            'fecha_lanzamiento' => "2000-05-15 12:00:00",
            'descripcion'=> "AGENTS OF THE CROWN. Relive an adventurous tale rich with agents, espionage, and conspiracies. Challenge deadly monsters and villains with your steel and magic. Clear your name by uncovering a sinister plot -- or perish in the attempt. A dark, cinematic adventure set in a richly detailed 3D world. Revolutionary battle & status system for incredible real-time attacks and combinations. Includes SQUARESOFT preview disc with playable demos",
            'plataforma'=> '["PlayStation 3","PC","Xbox 360","Macintosh"]',
            'editor'=> '["SquareSoft","Square Enix","Square EA"]',
            'desarrollador'=> '["SquareSoft"]',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
