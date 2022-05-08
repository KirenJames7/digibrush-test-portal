<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Company::truncate();
        Employee::truncate();
        Menu::truncate();

        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'is_admin' => true
        ]);

        $companies = Company::factory(20)->create();
        foreach ( $companies as $company ) {
            Employee::factory(mt_rand(15,30))->create([
                'company_id' => $company->id,
            ]);
        }

        // experiment
        foreach ( [ "Companies", "Employees" ] as $menu ) {
            Menu::create([
                'label' => $menu,
                'slug' => strtolower($menu)
            ]);
        }
    }
}
