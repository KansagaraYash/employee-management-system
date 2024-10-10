<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'ABC Company',
                'email' => 'admin@company.com',
                'logo' => null,
                'website' => null,
            ]
        ];

        foreach ($companies as $company) {
            Company::create($company);
        } 
    }
}
