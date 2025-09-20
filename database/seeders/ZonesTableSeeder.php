<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zones = [
            'Colombo' => ['Colombo Zone 1', 'Colombo Zone 2'],
            'Gampaha' => ['Negombo Zone', 'Minuwangoda Zone'],
            'Kalutara' => ['Kalutara Zone', 'Panadura Zone'],
            'Kandy' => ['Kandy Zone 1', 'Gampola Zone'],
            'Jaffna' => ['Jaffna Zone', 'Vaddukoddai Zone'],
            'Galle' => ['Galle Zone', 'Elpitiya Zone'],
            'Kurunegala' => ['Kurunegala Zone', 'Kuliyapitiya Zone'],
            'Anuradhapura' => ['Anuradhapura Zone'],
            'Badulla' => ['Badulla Zone', 'Bandarawela Zone'],
            'Ratnapura' => ['Ratnapura Zone', 'Balangoda Zone'],
        ];

        foreach ($zones as $districtName => $zoneList) {
            $district = DB::table('districts')->where('name', $districtName)->first();

            if ($district) {
                foreach ($zoneList as $zone) {
                    DB::table('zones')->updateOrInsert(
                        ['name' => $zone, 'district_id' => $district->id],
                        ['created_at' => now(), 'updated_at' => now()]
                    );
                }
            }
        }
    }
}
