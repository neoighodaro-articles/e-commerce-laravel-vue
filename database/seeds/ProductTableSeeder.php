<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$products = [
    		[
    			'name' => "MEN'S BETTER THAN NAKED&trade; JACKET",
    			'description' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua consequat.",
    			'units' => 21,
    			'price' => 200.10,
    			'image' => "http://images.thenorthface.com/is/image/TheNorthFace/236x204_CLR/mens-better-than-naked-jacket-AVMH_LC9_hero.png"
    		],
    		[
    			'name' => "WOMEN'S BETTER THAN NAKED&trade; JACKET",
    			'description' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua consequat.",
    			'units' => 400,
    			'price' => 1600.21,
    			'image' => "http://images.thenorthface.com/is/image/TheNorthFace/236x204_CLR/womens-better-than-naked-jacket-AVKL_NN4_hero.png"
    		],
    		[
    			'name' => "WOMEN'S SINGLE-TRACK SHOE",
    			'description' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua consequat.",
    			'units' => 37,
    			'price' => 378.00,
    			'image' => "http://images.thenorthface.com/is/image/TheNorthFace/236x204_CLR/womens-single-track-shoe-ALQF_JM3_hero.png"
    		],
    		[
    			'name' => "Enduro Boa&reg; Hydration Pack",
    			'description' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua consequat.",
    			'units' => 10,
    			'price' => 21.10,
    			'image' => "http://images.thenorthface.com/is/image/TheNorthFace/236x204_CLR/enduro-boa-hydration-pack-AJQZ_JK3_hero.png"
    		]
    	];

    	foreach ($products as $product) {
    		Product::create($product);
    	}

    }
}
