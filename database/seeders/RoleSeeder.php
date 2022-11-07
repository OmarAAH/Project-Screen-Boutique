<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id' => 1,
                'role' => 'Administrador'
            ],
            [
                'id' => 2,
                'role' => 'Inventario' 
            ],
            [
                'id' => 3,
                'role' => 'Vendedor'
            ]
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
