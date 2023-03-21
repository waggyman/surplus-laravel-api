<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Image;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            [
                'name' => 'hat',
                'file' => '/images/hat.jpg',
                'enable' => true
            ],
            [
                'name' => 'bottle',
                'file' => '/images/bottle.jpg',
                'enable' => true
            ],
            [
                'name' => 'shirt',
                'file' => '/images/shirt.jpg',
                'enable' => true
            ],
            [
                'name' => 'sock',
                'file' => '/images/sock.jpg',
                'enable' => true
            ],
            [
                'name' => 'bike',
                'file' => '/images/bike.jpg',
                'enable' => true
            ],
        ];

        foreach ($images as $image) {
            $newImg = Image::create($image);
            $newImg->products()->attach($newImg->id);
        }
    }
}
