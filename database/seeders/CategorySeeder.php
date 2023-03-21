<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'hat',
                'enable' => true
            ],
            [
                'name' => 'bottle',
                'enable' => true
            ],
            [
                'name' => 'top',
                'enable' => true
            ]
        ];
        foreach ($categories as $category) {
            $newCategory = Category::create($category);
            $newCategory->products()->attach($newCategory->id);
        }
    }
}
