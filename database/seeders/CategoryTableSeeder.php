<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Bug Report'],
            ['name' => 'Feature Request'],
            ['name' => 'Technical Support'],
            // Add more categories as needed
        ];

        DB::table('categories')->insert($categories);
    }
}
