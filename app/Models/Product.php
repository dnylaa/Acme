<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; 

    protected $fillable = [
        'user_id',
        'category_id',
        'product_type_id', // ID untuk jenis produk
        'title',
        'meta_desc',
        'slug',
        'content',
        'how_to_use',
        'ingredients',
        'image',
        'status',
        'sku',
        'price', 
        'discount',
        'stock', 
        'sold'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relasi Many-to-One dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi Many-to-One dengan Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi One-to-Many dengan Article
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // Relasi Many-to-One dengan ProductType
    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    // Relasi One-to-Many dengan Testimonial
    public function averageRating()
    {
        return $this->testimonials()->avg('rating');
    }

    public function testimonialsCount()
    {
        return $this->testimonials()->count();
    }
}
