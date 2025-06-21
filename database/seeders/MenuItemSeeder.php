<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [1, 1, null, 'Soep Ling Fa', 3.8, 'SOEP', null],
            [2, 2, null, 'Kippensoep', 2.9, 'SOEP', ''],
            [3, 3, null, 'Tomatensoep', 2.9, 'SOEP', null],
        ];

        foreach ($items as [$id, $menuNumber, $menuSuffix, $name, $price, $type, $description]) {
            $dishTypeId = DB::table('dish_types')->where('name', $type)->value('id');

            DB::table('menu_items')->insert([
                'id' => $id,
                'menu_number' => $menuNumber,
                'menu_suffix' => $menuSuffix,
                'name' => $name,
                'price' => $price,
                'dish_type_id' => $dishTypeId,
                'description' => $description,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
