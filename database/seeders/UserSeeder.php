<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Area;
use App\Models\Planteles;
use App\Models\Tareas;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
        'name' => 'nacho',
        'email' => 'nacho@test.com',
        'password' => bcrypt('12345678'),
        'area_id' => 1,
        'plantel_id' => 1

        ])->assignRole('Superusuario');

             User::create([
        'name' => 'carlos',
        'email' => 'carlos@test.com',
        'password' => bcrypt('12345678'),
        'area_id' => 1,
        'plantel_id' => 1

        ])->assignRole('Supervisor');
             User::create([
        'name' => 'joaquin',
        'email' => 'joaquin@test.com',
        'password' => bcrypt('12345678'),
        'area_id' => 1,
        'plantel_id' => 1

        ])->assignRole('Usuario');

             User::create([
        'name' => 'jose',
        'email' => 'jose@test.com',
        'password' => bcrypt('12345678'),
        'area_id' => 2,
        'plantel_id' => 1

        ])->assignRole('Supervisor');
             User::create([
        'name' => 'taco',
        'email' => 'taco@test.com',
        'password' => bcrypt('12345678'),
        'area_id' => 2,
        'plantel_id' => 1

        ])->assignRole('Usuario');
               User::create([
        'name' => 'dore',
        'email' => 'dore@test.com',
        'password' => bcrypt('12345678'),
        'area_id' => 2,
        'plantel_id' => 1

        ])->assignRole('Usuario');




        Planteles::create([

            'nombre_plantel' => 'Rectoria'
        ]);
         Area::create([

            'nombre_area' => 'Sistemas',
            'id_plantel' => 1,
            'id_supervisor_area' => 1
        ]);
                  Area::create([

            'nombre_area' => 'Archivo',
            'id_plantel' => 1,
            'id_supervisor_area' => 4
        ]);


            Tareas::create([

            'tarea' => 'Restablecer Correo',
            'id_area' => 1,
            'id_user' => 1
        ]);
            Tareas::create([

            'tarea' => 'No hay internet',
            'id_area' => 1
        ]);

            Tareas::create([

            'tarea' => 'Certificado',
            'id_area' => 2,
            
        ]);
        
  
    }
}
