<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['nomCategorie' => 'Électronique']);
        Category::create(['nomCategorie' => 'Vêtements']);
        Category::create(['nomCategorie' => 'Alimentation']);
        Category::create(['nomCategorie' => 'Meubles']);
    }
}