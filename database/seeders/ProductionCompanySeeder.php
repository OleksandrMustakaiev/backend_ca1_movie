<?php

namespace Database\Seeders;

use App\Models\ProductionCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductionCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductionCompany::factory()
        ->times(3)
        ->hasMovies(4)
        ->create();
    }
}
