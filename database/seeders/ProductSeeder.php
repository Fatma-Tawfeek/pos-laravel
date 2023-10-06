<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => [
                'ar' => 'المنتج الاول',
                'en' => 'First Product'
            ],
            'description' => [
                'ar' => 'وصف المنتج الاول',
                'en' => 'First Product description'
            ],
            'category_id' => rand(1,3),
            'image' => 'default.png',
            'purchase_price' => 100,
            'sale_price' => 150,
            'stock' => 100
        ]);

        Product::create([
            'name' => [
                'ar' => 'المنتج الثاني',
                'en' => 'second Product'
            ],
            'description' => [
                'ar' => 'وصف المنتج الثاني',
                'en' => 'second Product description'
            ],
            'category_id' => rand(1,3),
            'image' => 'default.png',
            'purchase_price' => 100,
            'sale_price' => 150,
            'stock' => 100
        ]);

        Product::create([
            'name' => [
                'ar' => 'المنتج الثالث',
                'en' => 'Third Product'
            ],
            'description' => [
                'ar' => 'وصف المنتج الثالث',
                'en' => 'Third Product description'
            ],
            'category_id' => rand(1,3),
            'image' => 'default.png',
            'purchase_price' => 100,
            'sale_price' => 150,
            'stock' => 100
        ]);
    }
}
