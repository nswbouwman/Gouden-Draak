<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::role('admin')->count() == 0) {
            $role = Role::firstOrCreate(['name' => 'admin']);

            $user = User::create([
                'name' => 'Jing Jang Admin',
                'email' => 'admin@goudendraak.nl',
                'password' => Hash::make('123'),
            ]);

            $user->assignRole($role);
        }
    }
}
