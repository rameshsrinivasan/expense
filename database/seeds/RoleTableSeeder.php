<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run() {
        $role = [
        	[
        		'name' => 'admin',
        		'display_name' => 'Administrator',
        		'description' => 'Administer the website and manage users'
        	],
        	[
        		'name' => 'moderator',
        		'display_name' => 'Moderator',
        		'description' => 'Moderator'
        	],
        	[
        		'name' => 'user',
        		'display_name' => 'User',
        		'description' => 'User'
        	]
        ];
        foreach ($role as $key => $value) {
        	Role::create($value);
        }
    }
}