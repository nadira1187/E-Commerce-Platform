<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Create a seller user first
        $seller = User::create([
            'name' => 'Fashion Store',
            'email' => 'seller@stylehub.com',
            'password' => bcrypt('password123'),
            'user_type' => 'seller',
            'email_verified_at' => now(),
        ]);

        $products = [
            [
                'name' => 'Classic Cotton T-Shirt',
                'description' => 'Comfortable and stylish cotton t-shirt perfect for everyday wear.',
                'images'=>'https://i.ibb.co/zTYLdzm7/fionaa-trendz-men-mint-green-printed-cotton-blend-round-neck-t-shirt-m-product-images-rvrgpdc3ab-0-2.webp',
                'price' => 29.99,
                'original_price' => 39.99,
                'category' => 'men',
                'sizes' => ['S', 'M', 'L', 'XL'],
                'colors' => ['Black', 'White', 'Navy'],
                'stock_quantity' => 100,
                'seller_id' => $seller->id,
                'status' => 'active',
                'featured' => true,
            ],
            [
                'name' => 'Elegant Summer Dress',
                'description' => 'Beautiful summer dress perfect for any occasion.',
                'images'=>'https://i.ibb.co/zTYLdzm7/fionaa-trendz-men-mint-green-printed-cotton-blend-round-neck-t-shirt-m-product-images-rvrgpdc3ab-0-2.webp',
                'price' => 79.99,
                'original_price' => 99.99,
                'category' => 'women',
                'sizes' => ['XS', 'S', 'M', 'L'],
                'colors' => ['Floral', 'Solid Blue', 'Red'],
                'stock_quantity' => 50,
                'seller_id' => $seller->id,
                'status' => 'active',
                'featured' => true,
            ],
            [
                'name' => 'Kids Denim Jacket',
                'description' => 'Stylish denim jacket for kids.',
                'images'=>'https://i.ibb.co/zTYLdzm7/fionaa-trendz-men-mint-green-printed-cotton-blend-round-neck-t-shirt-m-product-images-rvrgpdc3ab-0-2.webp',
                'price' => 49.99,
                'original_price' => 59.99,
                'category' => 'kids',
                'sizes' => ['2T', '3T', '4T', '5T'],
                'colors' => ['Light Blue', 'Dark Blue'],
                'stock_quantity' => 30,
                'seller_id' => $seller->id,
                'status' => 'active',
                'featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}