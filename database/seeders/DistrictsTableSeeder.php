<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = [
            'Colombo',
            'Gampaha',
            'Kalutara',
            'Kandy',
            'Matale',
            'Nuwara Eliya',
            'Galle',
            'Matara',
            'Hambantota',
            'Jaffna',
            'Kilinochchi',
            'Mannar',
            'Vavuniya',
            'Mullaitivu',
            'Batticaloa',
            'Ampara',
            'Trincomalee',
            'Kurunegala',
            'Puttalam',
            'Anuradhapura',
            'Polonnaruwa',
            'Badulla',
            'Monaragala',
            'Ratnapura',
            'Kegalle',
        ];

        foreach ($districts as $district) {
            DB::table('districts')->updateOrInsert(
                ['name' => $district],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
