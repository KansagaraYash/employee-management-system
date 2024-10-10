<?php

namespace Database\Seeders;

use App\Models\Preference;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $preferences = [
            [
                'code' => 'EMP',
                'value' => 0,
                'name' => 'Employee',
            ],
        ];

        foreach ($preferences as $preference) {
            Preference::updateOrCreate([
                'code' => $preference['code']
            ], $preference);
        }
    }
}
