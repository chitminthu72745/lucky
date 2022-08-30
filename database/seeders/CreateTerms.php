<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Term;

class CreateTerms extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $terms = [
            [
                'attribute_id'=> 1,
                'terms_name'=>'Red',
                'slug'=>'red',
                'description'=>'red',
            ],
            [
                'attribute_id'=> 1,
                'terms_name'=>'Green',
                'slug'=>'green',
                'description'=>'green',
            ],
            [
                'attribute_id'=> 1,
                'terms_name'=>'Blue',
                'slug'=>'blue',
                'description'=>'blue',
            ],
            [
                'attribute_id'=> 2,
                'terms_name'=>'Small',
                'slug'=>'small',
                'description'=>'small',
            ],
            [
                'attribute_id'=> 2,
                'terms_name'=>'Medium',
                'slug'=>'medium',
                'description'=>'medium',
            ],
            [
                'attribute_id'=> 2,
                'terms_name'=>'Large',
                'slug'=>'large',
                'description'=>'large',
            ],
            [
                'attribute_id'=> 3,
                'terms_name'=>'10kg',
                'slug'=>'tenkg',
                'description'=>'10kg',
            ],
            [
                'attribute_id'=> 3,
                'terms_name'=>'20kg',
                'slug'=>'twentykg',
                'description'=>'twentykg',
            ],
            [
                'attribute_id'=> 3,
                'terms_name'=>'30kg',
                'slug'=>'thirtykg',
                'description'=>'thirtykg',
            ],
        ];
        foreach ($terms as $key => $value) {
            Term::create($value);
        }
    }
}
