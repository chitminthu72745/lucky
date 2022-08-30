<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attribute;

class CreateAttribute extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributes = [
            [
                'name'=>'Color',
                'slug'=>'color',
                'type'=>'color',
            ],
            [
                'name'=>'Size',
                'slug'=>'size',
                'type'=>'size',
            ],
            [
                'name'=>'Weight',
                'slug'=>'weight',
                'type'=>'weight',
            ],
        ];
        foreach ($attributes as $key => $value) {
            Attribute::create($value);
        }
    }
}
