<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductTypeController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\InboxController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\InformationController;
use App\Http\Controllers\TestimonialController as UserTestimonialController; //untuk user
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController; //untuk admin
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\HomeController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;


// Route landing page
Route::get('/', [HomeController::class, 'index'])->name('home.main'); 
Route::get('/products', [HomeController::class, 'products'])->name('home.product.index');
Route::get('/articles', [HomeController::class, 'articles'])->name('home.articles.index');
Route::get('/articles/{slug}', [HomeController::class, 'articlesShow'])->name('home.articles.show');
Route::get('/articles/categories/{categoryId}', [HomeController::class, 'articlesCategories'])->name('home.articles.categories');
Route::get('/information', [HomeController::class, 'information'])->name('home.information.index');
Route::get('/information/{slug}', [HomeController::class, 'informationShow'])->name('home.information.show');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact.index');
Route::post('/contact', [HomeController::class, 'contactStore'])->name('home.contact.store');
Route::get('/team', [HomeController::class, 'team'])->name('home.team.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about.index');
Route::get('/products/types/{typeId}', [HomeController::class, 'productTypes'])->name('home.product.productTypes');
Route::get('/products/{id}', [HomeController::class, 'productShow'])->name('home.product.show');
Route::get('/testimonials', [HomeController::class, 'testimonials'])->name('home.testimonials.index');
Route::post('/testimonials', [UserTestimonialController::class, 'store'])->name('testimonials.store')->middleware('auth');
Route::put('/testimonials/{testimonial}', [UserTestimonialController::class, 'update'])->name('testimonials.update')->middleware('auth');
Route::delete('/testimonials/{testimonial}', [UserTestimonialController::class, 'destroy'])->name('testimonials.destroy')->middleware('auth');
// ROUTE FILTER PRODUK
Route::get('/products', [ProductController::class, 'frontendIndex'])
    ->name('home.product.index');

Route::get('/products/{product}', [ProductController::class, 'frontendShow'])
    ->name('home.product.show');


//Route untuk melihat detail order dari user yang login
Route::middleware(['auth'])->group(function () {
    Route::get('/orders/{id}/dashboard', [OrderController::class, 'showDashboard'])
    ->name('home.orders.showdashboard');
});

// =====================
// Routes untuk Keranjang
// =====================
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index'); // tampilkan keranjang
    Route::post('/add/{product}', [CartController::class, 'addItem'])->name('add')->middleware('auth');
    Route::post('/update/{slug}', [CartController::class, 'update'])->name('update'); // update qty
    Route::delete('/remove/{slug}', [CartController::class, 'remove'])->name('remove'); // hapus item
});

// =====================
// Routes untuk Checkout
// =====================
Route::prefix('checkout')->name('checkout.')->middleware('auth')->group(function () {
    Route::get('/', [CartController::class, 'checkout'])->name('index'); // form checkout
    Route::post('/process', [CartController::class, 'processCheckout'])->name('process'); // simpan order
    Route::get('/success/{orderId}', [CartController::class, 'checkoutSuccess'])->name('success'); // halaman sukses
});


Route::get('/orders/{order}', [OrderController::class, 'show']);

Route::prefix('cart-items')->group(function () {
    Route::get('/', [CartItemController::class, 'index']);
    Route::post('/', [CartItemController::class, 'store']);
    Route::put('/{id}', [CartItemController::class, 'update']);
    Route::delete('/{id}', [CartItemController::class, 'destroy']);
});

Route::prefix('orders')->group(function () {
    Route::get('{order}/items', [OrderItemController::class, 'index']);
    Route::get('items/{id}', [OrderItemController::class, 'show']);
    Route::put('items/{id}', [OrderItemController::class, 'update']); // optional
    Route::delete('items/{id}', [OrderItemController::class, 'destroy']); // optional
});





// Lupa password
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');// untuk menampilkan form reset password (form isi password baru).
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');// untuk mengirim email reset password ke user yang lupa passwordnya.

// Reset password
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->middleware('guest')
    ->name('password.reset'); //buka halaman untuk isi password baru (dengan token dari email).
Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update'); //simpan password baru yang sudah diisi user.

    

//Route semua pengguna
Route::middleware(['auth'])->name('admin.')->group(function () {
    //route untuk dashboard
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('admin/articles', ArticleController::class); // manajemen artikel

    // Rute profil user yang login
    Route::get('admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('admin/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('admin/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

// Route hanya untuk admin
Route::middleware(['auth', 'role:admin,author'])->prefix('admin')->name('admin.')->group(function () {
    // Semua rute di dalam grup ini akan memerlukan otentikasi dan peran 'admin'
    Route::resource('admin/users', UserController::class); // manajemen user
    Route::resource('admin/categories', CategoryController::class); // manajemen kategori
    Route::resource('admin/product-types', ProductTypeController::class);
    Route::resource('admin/products', ProductController::class); // manajemen produk
    Route::resource('admin/informations', InformationController::class); // manajemen informasi
    Route::resource('admin/testimonials', AdminTestimonialController::class)->except(['create', 'store', 'edit', 'update']);
    Route::patch('admin/testimonials/{id}/status', [AdminTestimonialController::class, 'updateStatus'])->name('testimonials.updateStatus');
    Route::resource('orders', AdminOrderController::class)->except(['create','store','edit']);
    Route::put('orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    //Route untuk inbox
    Route::get('admin/inbox', [InboxController::class, 'index'])->name('inbox.index');
    Route::put('admin/inbox/{inbox}/toggle-status', [InboxController::class, 'toggleStatus'])->name('inbox.toggleStatus');
    Route::delete('admin/inbox/{inbox}', [InboxController::class, 'destroy'])->name('inbox.destroy');

});