<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Product;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        if ($users->count() > 0 && $products->count() > 0) {
            foreach ($products as $product) {
                // ambil user random buat kasih testimoni
                $user = $users->random();

                Testimonial::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'name' => $user->name,
                    'message' => "Saya suka produk {$product->title}, kualitasnya bagus dan sangat bermanfaat!",
                    // 'photo' => null, // kalau ada bisa pakai avatar default
                    'status' => 'approved', // biar langsung muncul di frontend
                ]);
            }
        }    
    }
}
