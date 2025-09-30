<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::where('role', 'admin')->first();
        $authorUser = User::where('role', 'author')->first();
        $productTypes = ProductType::all();

        if ($adminUser && $authorUser && $productTypes->count() > 0) {
            for ($i = 1; $i <= 10; $i++) {
                $user = ($i % 2 == 0) ? $adminUser : $authorUser;
                $category = $productTypes->random();

                $title = "Sample Product " . $i . " - " . $category->name;
                $price = rand(10000, 100000); // Harga antara 10rb - 100rb
                $discount = rand(0, 1) ? rand(0, 100) : 0; // Bisa null atau diskon antara 1rb - 5rb
                $stock = rand(10, 100);
                $sku = 'SKU' . strtoupper(Str::random(6));

                Product::create([
                    'user_id' => $user->id,
                    'product_type_id' => $category->id, // Asumsikan ada 5 jenis produk
                    'title' => $title,
                    'meta_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    'slug' => Str::slug($title),
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                    'how_to_use' => 'Gunakan sesuai petunjuk: aplikasikan pada wajah secara merata, gunakan pagi dan malam.',
                    'ingredients' => 'Water, Glycerin, Aloe Vera Extract, Vitamin C, Fragrance.',
                    'image' => null,
                    'status' => true,
                    'price' => $price,
                    'discount' => $discount,
                    'stock' => $stock,
                    'sku' => $sku,
                ]);
            }
        }
        //
    }
}
