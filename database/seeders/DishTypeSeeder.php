<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DishTypeSeeder extends Seeder
{
    public function run()
    {
        $types = [
            'SOEP',
            'VOORGERECHT',
            'BAMI EN NASI GERECHTEN',
            'COMBINATIE GERECHTEN (met witte rijst)',
            'MIHOEN GERECHTEN',
            'CHINESE BAMI GERECHTEN',
            'INDISCHE GERECHTEN',
            'EIERGERECHTEN (met witte rijst)',
            'GROENTEN GERECHTEN (met witte rijst)',
            'VLEES GERECHTEN (met witte rijst)',
            'KIP GERECHTEN (met witte rijst)',
            'GARNALEN GERECHTEN (met witte rijst)',
            'OSSENHAAS GERECHTEN (met witte rijst)',
            'VISSEN GERECHTEN (met witte rijst)',
            'PEKING EEND GERECHTEN (met witte rijst)',
            'TIEPAN SPECIALITEITEN (met witte rijst)',
            'VEGETARISCHE GERECHTEN (met witte rijst)',
            'KINDERMENUS',
            'RIJSTTAFELS',
            'BUFFET',
            'DIVERSEN',
        ];

        foreach ($types as $type) {
            DB::table('dish_types')->insert([
                'name' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
