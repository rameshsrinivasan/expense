<?php

use Illuminate\Database\Seeder;

class SetPermissionTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run() {
        $permission_id_arr = DB::table('permissions')->select('id')->get();
        $admin_role_id = DB::table('roles')->select('id')->where('name', 'admin')->first()->id;
        $mod_role_id  = DB::table('roles')->select('id')->where('name', 'moderator')->first()->id;
        foreach ($permission_id_arr as $key => $permission_id) {
            $per_id = $permission_id->id;
            DB::table('permission_role')->insert( array(
                'permission_id' => $per_id,
                'role_id'  => $admin_role_id
            ));
        }
    }
}