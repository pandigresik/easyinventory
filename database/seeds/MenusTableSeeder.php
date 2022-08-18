<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menus')->delete();
        
        \DB::table('menus')->insert(array (
            0 => 
            array (
                '_lft' => 9,
                '_rgt' => 40,
                'created_at' => '2021-08-09 08:10:07',
                'description' => 'Header menu master',
                'icon' => 'cil-address-book',
                'id' => 1,
                'name' => 'Master Data',
                'parent_id' => NULL,
                'route' => NULL,
                'seq_number' => 1,
                'status' => '1',
                'updated_at' => '2021-10-29 14:51:54',
            ),
            1 => 
            array (
                '_lft' => 41,
                '_rgt' => 58,
                'created_at' => '2021-08-09 08:10:07',
                'description' => 'Header menu accounting',
                'icon' => 'cil-address-book',
                'id' => 2,
                'name' => 'Accounting',
                'parent_id' => NULL,
                'route' => NULL,
                'seq_number' => 2,
                'status' => '1',
                'updated_at' => '2021-10-29 14:51:57',
            ),
            2 => 
            array (
                '_lft' => 59,
                '_rgt' => 74,
                'created_at' => '2021-08-09 08:10:07',
                'description' => 'Header menu inventory',
                'icon' => 'cil-address-book',
                'id' => 3,
                'name' => 'Inventory',
                'parent_id' => NULL,
                'route' => NULL,
                'seq_number' => 3,
                'status' => '1',
                'updated_at' => '2021-10-29 14:51:59',
            ),
            3 => 
            array (
                '_lft' => 32,
                '_rgt' => 33,
                'created_at' => '2021-08-09 08:10:07',
                'description' => 'Manage menu',
                'icon' => 'cil-address-book',
                'id' => 4,
                'name' => 'Menu',
                'parent_id' => 1,
                'route' => 'base/menus',
                'seq_number' => 1,
                'status' => '1',
                'updated_at' => '2021-10-29 14:51:53',
            ),
            4 => 
            array (
                '_lft' => 34,
                '_rgt' => 35,
                'created_at' => '2021-08-09 08:10:07',
                'description' => 'Manage users',
                'icon' => 'cil-address-book',
                'id' => 5,
                'name' => 'User',
                'parent_id' => 1,
                'route' => 'base/users',
                'seq_number' => 2,
                'status' => '1',
                'updated_at' => '2021-10-29 14:51:54',
            ),
            5 => 
            array (
                '_lft' => 36,
                '_rgt' => 37,
                'created_at' => '2021-08-09 08:10:07',
                'description' => 'Manage role',
                'icon' => 'cil-address-book',
                'id' => 6,
                'name' => 'Role',
                'parent_id' => 1,
                'route' => 'base/roles',
                'seq_number' => 3,
                'status' => '1',
                'updated_at' => '2021-10-29 14:51:54',
            ),
            6 => 
            array (
                '_lft' => 38,
                '_rgt' => 39,
                'created_at' => '2021-08-09 08:10:07',
                'description' => 'Manage permissions',
                'icon' => 'cil-address-book',
                'id' => 7,
                'name' => 'Permission',
                'parent_id' => 1,
                'route' => 'base/permissions',
                'seq_number' => 1,
                'status' => '1',
                'updated_at' => '2021-10-29 14:51:54',
            )            
        ));
        
        
    }
}