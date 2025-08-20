<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 4; $i++) {
            DB::table('orders')->insert([
                'table_nr' => 1,
                'created_at' => now()->subMinutes($i * 10 + 10),
                'updated_at' => now()->subMinutes($i * 10 + 10),
            ]);
        }
    }
}
