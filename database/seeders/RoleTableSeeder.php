<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'LGU']);
        Role::create(['name' => 'PNP']);
        Role::create(['name' => 'BFP']);
        Role::create(['name' => 'NDRRMO']);
        Role::create(['name' => 'San Miguel Clinic']);
        Role::create(['name' => 'NGO']);
        Role::create(['name' => 'GBI']);
        Role::create(['name' => 'Residents']);
    }
}