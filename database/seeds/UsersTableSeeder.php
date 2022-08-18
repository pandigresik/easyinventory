<?php



use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'created_at' => '2021-10-26 22:21:17',
                'deleted_at' => NULL,                
                'email' => 'admin@admin.com',
                'email_verified_at' => NULL,                
                'id' => 1,
                'name' => 'Administrator',
                'password' => '$2y$10$Vi/M3mYzPevq1UG2m33ZZeO0oi8x2Vk/0Qihwd/hLBS4MrzGXe/nO',
                'remember_token' => NULL,
                'updated_at' => '2021-10-26 22:21:17',
            )            
        ));
        
        
    }
}