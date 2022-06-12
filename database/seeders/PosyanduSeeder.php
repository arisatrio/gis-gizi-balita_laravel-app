<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\RukunWarga;

class PosyanduSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rw = RukunWarga::create([
            'name'          => '01',
            'name_pic'      => 'Pak RW',
            'address'       => 'Jalan. jalan',
            'description'   => 'RT.01 & RT.02'
        ]);

        $rw->posyandu()->create([
            'name'      => 'Posyandu Josss',
            'name_pic'  => 'Ibu Joss',
            'address'   => 'Jl. JOSS No. 1',
            'latitude'  => '-6.736832328421767',
            'longitude' => '108.54727647235255',
            'status'    => 'active'
        ]);
    }
}
