<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@admin.com', 'password' => 'password', 'roles_id' => 1, 'created_date' => '2019-12-15 00:00:00'],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
