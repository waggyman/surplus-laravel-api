<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                "name" => "Energenic Hat",
                "description" => "Hat that can increase your Energy. Boost it up!",
                "enable" => true
            ],
            [
                "name" => "Energenic Bottle",
                "description" => "Bottle that can increase your Energy. Boost it up!",
                "enable" => true
            ],
            [
                "name" => "Energenic Shirt",
                "description" => "Shirt that can increase your Energy. Boost it up!",
                "enable" => true
            ],
            [
                "name" => "Energenic Socks",
                "description" => "Socks that can increase your Energy. Boost it up!",
                "enable" => true
            ],
            [
                "name" => "Energenic Bike",
                "description" => "Bike that can increase your Energy. Boost it up!",
                "enable" => true
            ]
        ];
        
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
