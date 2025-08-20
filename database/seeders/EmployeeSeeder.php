<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::role('employee')->count() == 0) {
            $role = Role::firstOrCreate(['name' => 'employee']);

            $user = User::create([
                'name' => 'medewerker1',
                'email' => 'medewerker1@goudendraak.nl',
                'password' => Hash::make('123'),
            ]);

            $user->assignRole($role);
        }
    }
}
