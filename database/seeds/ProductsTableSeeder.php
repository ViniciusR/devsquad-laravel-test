<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Smartphone',
            'description' => 'A great smartphone with Android.',
            'image' => 'storage/app/public/products/product1.jpg',
            'price' => 2000.00,
            'category_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('products')->insert([
            'name' => 'T-shirt',
            'description' => 'A nice t-shirt!',
            'image' => 'storage/app/public/products/product2.jpg',
            'price' => 30.00,
            'category_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('products')->insert([
            'name' => 'Playstation 4',
            'description' => 'No words, just amazing.',
            'image' => 'storage/app/public/products/product3.jpg',
            'price' => 1000.00,
            'category_id' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('products')->insert([
            'name' => 'Smart TV 50"',
            'description' => 'A smart tv with a great image quality.',
            'image' => 'storage/app/public/products/product4.jpg',
            'price' => 500.99,
            'category_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
