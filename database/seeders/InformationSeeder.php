<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Information;
use Illuminate\Support\Str;

class InformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Information::create([
            'title' => 'Welcome to Our Website',
            'meta_desc' => 'This is a brief description of our website.',
            'slug' => Str::slug('Welcome to Our Website'),
            'content' => 'This is the content of the welcome information. Here you can find various details about our services and offerings.',
            'status' => true,
        ]);
        
        //
    }
}
