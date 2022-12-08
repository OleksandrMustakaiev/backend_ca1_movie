<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Director;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DirectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Director::factory()
        ->times(3)
        ->create();

        foreach(Director::all() as $director)
        {
            $movies = Movie::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $director->movies()->attach($movies);
        }
    }
}
