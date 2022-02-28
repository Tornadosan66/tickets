<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Superusuario']);
        $role2 = Role::create(['name' => 'Supervisor']);
        $role3 = Role::create(['name' => 'Usuario']);
        


        Permission::create(['name' => 'planteles.home'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'planteles.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'planteles.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'planteles.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'planteles.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'areas.home'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'areas.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'areas.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'areas.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'areas.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'users.home'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'users.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'users.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'users.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'users.destroy'])->syncRoles([$role1,$role2]);

        Permission::create(['name' => 'supervisor.home'])->syncRoles([$role1,$role2]);

        Permission::create(['name' => 'tareas.home'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'tareas.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'tareas.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'tareas.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'tareas.destroy'])->syncRoles([$role1,$role2]);


        

        
    }


}
