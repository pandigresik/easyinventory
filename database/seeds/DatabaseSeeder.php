<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(MenusTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(MenuPermissionsTableSeeder::class);        
        $this->call(RolesTableSeeder::class);        
        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
