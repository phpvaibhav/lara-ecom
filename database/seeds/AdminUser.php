<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Profile;
class AdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
        	'name'         =>'Customer',
        	'description' => 'Customer Role'
        ]); 
        $role = Role::create([
        	'name'=>'Admin',
        	'description' => 'Admin Role'
        ]);
        $user = User::create([
        	'name'=>'Admin',
        	'email' => 'admin@admin.com',
        	'password'=> bcrypt('123456'),
        	'role_id' => $role->id
        ]);  
        $profile = Profile::create([
        	'user_id'=> $user->id,
        
        ]); 
    }
}
