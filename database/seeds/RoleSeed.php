<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'description' => 'Administrator', 'created_date' => '2019-12-15 00:00:00'],
            ['id' => 2, 'description' => 'User', 'created_date' => '2019-12-15 00:00:00'],

        ];

        foreach ($items as $item) {
            \App\Role::create($item);
        }
    }
}
