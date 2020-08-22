<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->truncate();
        DB::table('users')->insert(
          [
            'id'=>1,
            'name' => 'Admin',
            'email'=> 'admin@gmail.com',
            'password'=> bcrypt('admin123')
          ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
