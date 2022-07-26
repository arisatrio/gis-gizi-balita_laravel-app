<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Balita;
use App\Models\User;

class BalitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::active()->masyarakat()->first();
        $balita = $user->parent()->create([
            'id_kia'            => '12345678',
            'tb_posyandu_id'    => 1,
            'name'              => 'Bayi gede',
            'birth'             => '2020-01-01',
            'gender'            => 'L',
            'address'           => 'Jalan saja',
        ]);

        $balita->checkUp()->create([
            'user_id'       => $user->id,
            'check_date'    => \Carbon\Carbon::now(),
            'bb'            => 12,
            'tb'            => 12,
            'lk'            => 12,
            'ld'            => 12,
        ]);
    }
}
