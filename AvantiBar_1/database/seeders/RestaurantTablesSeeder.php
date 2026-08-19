<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantTablesSeeder extends Seeder
{
    public function run()
    {
        $tables = [];
        $classes = ['budget', 'second', 'first'];
        $capacities = [2, 4, 6, 8, 10, 12];

        foreach ($classes as $class) {
            foreach ($capacities as $capacity) {
                $tables[] = [
                    'capacity' => $capacity,
                    'class' => $class,
                    'status' => 'free',
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        DB::table('restaurant_tables')->insert($tables);
    }
}