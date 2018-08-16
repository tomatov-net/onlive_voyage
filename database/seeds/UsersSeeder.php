<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(\App\User::class, 3)->create();

        $users = [
            ['name' => 'Admin', 'email' => 'admin@admin.com', 'password' => bcrypt('password')],
        ];

        foreach ($users as $item) {
            \App\User::create($item);
        }
    }
}
