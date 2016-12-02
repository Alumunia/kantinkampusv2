<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Admin
        DB::table('admin')->insert([
            'username' => 'lctip2016',
            'password' => bcrypt('123_lctip2016_123'),
            'role' => 'admin'
        ]);
        // Super Admin
          DB::table('admin')->insert([
            'username' => 'superadmin_lctip-2016',
            'password' => bcrypt('superadmin_lctip-2016_superadmin'),
            'role' => 'superAdmin'
        ]);
    }

}
