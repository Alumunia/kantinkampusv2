<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call(AdminTableSeeder::class);
        $this->call(FieldRegistrationSeeder::class);
        $this->call(MemberTableSeeder::class);
        factory(App\Member::class, 10)->create();
//        DB::table('member')->insert([
//            'username' => 'root',
//            'password' => bcrypt('root'),
//        ]);
    }

}
