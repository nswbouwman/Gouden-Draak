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

            $menuItemId = rand(1, 165);
            $price = DB::table('menu_items')->where('id', $menuItemId)->value('price');

            DB::table('order_items')->insert([
                'order_id' => $i + 1,
                'menu_item_id' => $menuItemId,
                'quantity' => rand(1, 3),
                'price' => $price,
                'created_at' => now()->subMinutes($i * 10 + 10),
                'updated_at' => now()->subMinutes($i * 10 + 10),
            ]);
        }
    }
}
