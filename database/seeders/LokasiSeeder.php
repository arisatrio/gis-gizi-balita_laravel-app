<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Lokasi;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = base_path().'/public/files/sunyaragi.geojson';
        $file = file_get_contents($path);
        $cek = str_replace(array("\r", "\n", "\t"), '', $file);
        $data = json_decode($cek, true);

        if(array_key_exists("province", $data) && array_key_exists("district", $data) && array_key_exists('sub_district', $data) && array_key_exists('village', $data) && array_key_exists("border", $data)) {    
            Lokasi::create([
                'province'      => $data['province'],
                'district'      => $data['district'],
                'sub_district'  => $data['sub_district'],
                'village'       => $data['village'],
                'border'        => serialize($data['border'])
            ]);
        }
    }
}
