<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\DataTraining;

class DataTrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jk     = ['L', 'P', 'L', 'P', 'P', 'L', 'P', 'L', 'P', 'L', 'L', 'P', 'L', 'P', 'L', 'L', 'P', 'L', 'L', 'L', 'L', 'L', 'P', 'L', 'P', 'P', 'L', 'P'];
        $umur   = [40, 38, 15, 37, 2, 49, 30, 21, 11, 15, 36, 40, 49, 42, 23, 2, 3, 49, 38, 42, 49, 40, 18, 14, 2, 16, 7, 22];
        $bb     = [10.5, 9.7, 8.7, 17, 6.7, 13, 9.9, 9.3, 7.3, 10.6, 10.5, 13.8, 12.8, 15.6, 10.5, 4.8, 5, 20.8, 12.5, 16, 11.5, 13.5, 13.1, 9.5, 4, 9.5, 7, 10.2];

        for($i=0; $i<count($jk); $i++) {
            $status = 1;
            if($i <= 1) {
                $status = 0;
            };

            $jenkel = 1;
            if($jk[$i] === 'P') {
                $jenkel = 0;
            }

            DataTraining::create([
                'umur'  => $umur[$i],
                'jk'    => $jenkel,
                'bb'    => $bb[$i],
                'status'=> $status,
            ]);
        }

    }
}
