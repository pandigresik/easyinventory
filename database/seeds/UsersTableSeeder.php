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
                'created_at' => now(),
                'deleted_at' => NULL,                
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),                
                'id' => 1,
                'name' => 'Administrator',
                'password' => Hash::make('admin@admin.com'),
                'remember_token' => NULL,
                'updated_at' => now(),
            )            
        ));
        
        
    }
}