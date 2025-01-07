<?php

namespace Database\Seeders;

use Database\Factories\MedicineFactory;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MedicineFactory::factory()->count(5)->create();
    }
}
