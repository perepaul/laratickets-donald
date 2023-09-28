<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriorityTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $priorities = [
            ['name' => 'Low'],
            ['name' => 'Medium'],
            ['name' => 'High'],
            // Add more priorities as needed
        ];

        DB::table('priorities')->insert($priorities);
    }
}
