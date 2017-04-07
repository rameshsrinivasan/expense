<?php

use Illuminate\Database\Seeder;
use App\User;

class SetRoleTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run() {
        $admin_user_id = DB::table('users')->select('id')->where('email', 'admin@admin.com')->first()->id;
        $mod_user_id  = DB::table('users')->select('id')->where('email', 'moderator@admin.com')->first()->id;
        $user_user_id = DB::table('users')->select('id')->where('email', 'user@user.com')->first()->id;

        $admin_role_id = DB::table('roles')->select('id')->where('name', 'admin')->first()->id;
        $mod_role_id  = DB::table('roles')->select('id')->where('name', 'moderator')->first()->id;
        $user_role_id = DB::table('roles')->select('id')->where('name', 'user')->first()->id;
        DB::table('role_user')->insert( array(
            array(
                'user_id' => $admin_user_id,
                'role_id'  => $admin_role_id
            ),
            array(
                'user_id' => $mod_user_id,
                'role_id'  => $mod_role_id
            ),
            array(
                'user_id' => $user_user_id,
                'role_id'  => $user_role_id
            ),
        ));
    }
}