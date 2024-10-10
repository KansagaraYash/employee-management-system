<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();
        try {
            $employeeNumber = get_dynamic_sequence('EMP', null, 'employee_number_length');
            
            User::updateOrCreate([
                'first_name'    => 'Super',
                'last_name'     => 'Admin',
                'email'         => 'super@admin.com',
                'type'          => 'SA',
                'employee_number' => $employeeNumber
            ], [
                'password' => Hash::make('password'),
            ]);

            $employeeNumber = get_dynamic_sequence('EMP', null, 'employee_number_length');

            $company = Company::first();

            $user = User::updateOrCreate([
                'first_name'      => 'Company',
                'last_name'       => 'Admin',
                'email'           => 'admin@company.com',
                'type'            => 'CA',
                'employee_number' => $employeeNumber
            ], [
                'password' => Hash::make('password'),
            ]);

            $company->users()->attach($user->id);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
