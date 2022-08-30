<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CreateCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'cat_name' => 'electronic',
                'cat_image' => 'test.jpg',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus porro tenetur magni eius aliquid delectus impedit adipisci ducimus hic commodi ipsam, sit aut quibusdam et veniam nihil perferendis fuga dolor!',
            ],
            [
                'cat_name' => 'accessories',
                'cat_image' => 'test.jpg',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus porro tenetur magni eius aliquid delectus impedit adipisci ducimus hic commodi ipsam, sit aut quibusdam et veniam nihil perferendis fuga dolor!',
            ],
            [
                'cat_name' => 'fashion',
                'cat_image' => 'test.jpg',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus porro tenetur magni eius aliquid delectus impedit adipisci ducimus hic commodi ipsam, sit aut quibusdam et veniam nihil perferendis fuga dolor!',
            ],
            [
                'cat_name' => 'cosmetics',
                'cat_image' => 'test.jpg',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus porro tenetur magni eius aliquid delectus impedit adipisci ducimus hic commodi ipsam, sit aut quibusdam et veniam nihil perferendis fuga dolor!',
            ],
        ];
        foreach ($categories as $key => $value) {
            Category::create($value);
        }
    }
}
