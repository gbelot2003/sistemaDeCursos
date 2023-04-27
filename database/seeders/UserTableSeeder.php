<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('users')->delete();

        \App\Models\User::factory()->create([
            'name' => 'Gerardo Belot',
            'email' => 'gbelot2003@hotmail.com',
        ]);

        \App\Models\User::factory(10)->create();
    }
}
