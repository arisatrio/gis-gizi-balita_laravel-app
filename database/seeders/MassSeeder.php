<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\RukunWarga;
use App\Models\User;

class MassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for($i=0; $i < 9; $i++) {
            $rw = RukunWarga::with('posyandu')->create([
                'name'          => '0'.($i+1),
                'name_pic'      => 'Pak RW '.($i+1),
                'address'       => 'Jalan. jalan',
                'description'   => '-'
            ]);
            
            $posyandu = $rw->posyandu()->create([
                'name'      => 'Posyandu '.($i+1),
                'name_pic'  => 'Ibu Posyandu '.($i+1),
                'address'   => 'Jl. JOSS No. 1',
                'latitude'  => '-6.736832328421767',
                'longitude' => '108.54727647235255',
                'status'    => 'active'
            ]);
            
            for($j=0; $j<12; $j++) {
                $user = User::create([
                    'name'      => 'masyarakat '.($j+1).'',
                    'email'     => 'masyarakat '.($j+1).'@mail.com',
                    'password'  => bcrypt('password'),
                    'role'      => 'Masyarakat',
                ]);
    
                $gender = 'L';
                if($i >= 8) {
                    $gender = 'P';
                }
                $balita = $user->parent()->create([
                    'id_kia'            => rand(100000, 999999),
                    'tb_posyandu_id'    => $i+1,
                    'name'              => 'Bayi '.($j+1),
                    'birth'             => \Carbon\Carbon::today()->subDays(rand(0, 365)),
                    'gender'            => $gender,
                    'address'           => '-',
                ]);
            }
        }

    }
}
