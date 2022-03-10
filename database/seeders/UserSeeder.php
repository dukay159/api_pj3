<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InforUser;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\InforUser::factory()->count(30)->create();
    }
}
