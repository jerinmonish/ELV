<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
	            'name' => 'admin',
	            'email' => 'admin@gmail.com',
	            'role' => 'admin',
	            'user_status' => 'Active',
	            'password' => bcrypt('admin@123')
	        ]);
    }
}
