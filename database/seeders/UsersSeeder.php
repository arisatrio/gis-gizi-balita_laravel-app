<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'  => 'admin',
            'email' => 'admin@mail.com',
            'password'  => bcrypt('password'),
            'role'      => 'Admin',
        ]);

        User::create([
            'name'  => 'Masyarakat',
            'email' => 'Masyarakat@mail.com',
            'password'  => bcrypt('password'),
            'role'      => 'Masyarakat',
        ]);
    }
}
