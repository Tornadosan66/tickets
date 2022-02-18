<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Area;
use App\Models\Planteles;

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

        Planteles::create([

            'nombre_plantel' => 'Rectoria'
        ]);
         Area::create([

            'nombre_area' => 'Sistemas',
            'id_plantel' => 1,
            'id_supervisor_area' => 1
        ]);

        
  
    }
}
