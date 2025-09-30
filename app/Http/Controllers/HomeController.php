<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\Article;
use App\Models\Information;
use App\Models\Category;
use App\Models\Contact;
use App\Models\ProductType;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //ngambil 3 produk terbaru
        $articles = Article::with(['user', 'category'])->where('status', true)->latest()->limit(4)->get();
        $products = Product::latest()->limit(3)->get();
        $testimonials = Testimonial::where('status', 'approved')->latest()->limit(6)->get();
        $sidebar= Information::latest()->limit(5)->get();
        $categories = Category::all();


        //tampilkan ke view
        return view('home.main', compact('products', 'articles', 'categories', 'sidebar', 'testimonials'));
        
        
    }

    //Controller untuk produk
    public function products(Request $request)
    {
        $query = Product::where('status', true)->latest();

        // Cek apakah ada parameter 'search' dalam request
        if($request->has('search')) {
            $searchTerm = $request->search;
            // Tambahkan kondisi pencarian berdasarkan nama atau email
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%'. $searchTerm . '%');
            });
        }
        //Ambil hasil paginasi
        $products = $query->paginate(6);
        $productTypes = ProductType::all();
        
        return view('home.product.index', compact('products', 'productTypes'));

    }

    //Controller tipe produk
    public function productTypes($typeId)
    {
        $productTypes = ProductType::all();
        $products = Product::where('product_type_id', $typeId)->get();

        return view('home.product.index', compact('products', 'productTypes'));
    }

    //Controller detail produk
    public function productShow($id)
    {
        $product = Product::findOrFail($id);
        $relatedProducts = Product::where('product_type_id', $product->product_type_id)->where('id', '!=', $product->id)->take(4)->get();
    
        return view('home.product.show', compact('product', 'relatedProducts'));
    }

    //Controller untuk artikel
    public function articles(Request $request)
    {
        $query = Article::where('status', true)->latest();

        // Cek apakah ada parameter 'search' dalam request
        if($request->has('search')) {
            $searchTerm = $request->search;
            // Tambahkan kondisi pencarian berdasarkan nama atau email
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%'. $searchTerm . '%');
            });
        }

        //Ambil hasil paginasi
        $articles = $query->paginate(6);

        $categories = Category::all();
        $sidebar = Information::latest()->limit(5)->get();

        return view('home.articles.index', compact('articles', 'categories', 'sidebar'));
    }

    public function articlesShow($slug)
    {
        // mengambil artikel berdasarkan slug
        $articles = Article::where('slug', $slug)->firstOrFail();
        $sidebar = Information::latest()->limit(5)->get();
        $categories = Category::all();

        return view('home.articles.show', compact('articles', 'sidebar', 'categories'));
    }

    public function articlesCategories($categoryId)
    {
        // mengambil artikel yg memiliki categori_id yg sesuai
        $articles = Article::where('category_id', $categoryId)
            ->where('status', true)
            ->latest()
            ->paginate(6);


        $categories = Category::all();
        $sidebar = Information::latest()->limit(5)->get();

        return view('home.articles.index', compact('articles', 'categories', 'sidebar'));
    }

    //Controller untuk informasi
    public function information(Request $request)
    {
        $query = Information::where('status', true)->latest();

        // Cek apakah ada parameter 'search' dalam request
        if ($request->has('search')) {
            $searchTerm = $request->search;
            // Tambahkan kondisi pencarian berdasarkan nama atau email
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%');
            });
        }

        // Ambil hasil paginasi
        $information = $query->paginate(6);

        $categories = Category::all();
        $sidebar = Article::latest()->limit(5)->get();

        return view('home.information.index', compact('information', 'categories', 'sidebar'));
    }

    public function informationShow($slug)
    {
        $information = Information::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $sidebar = Article::latest()->limit(5)->get();

        return view('home.information.show', compact('information', 'categories', 'sidebar'));
    }

   //Controller untuk testimonial
     public function testimonials()
    {
        $testimonials = Testimonial::where('status', 'approved')->latest()->paginate(6);
        return view('home.testimonials.index', compact('testimonials'));
    }

    //Controller untuk form kontak
    public function contact()
    {
        return view('home.contact.index');
    }

    public function contactStore(Request $request)
    {
        // Validasi data yang masuk dari form, termasuk reCAPTCHA
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            // Aturan validasi untuk reCAPTCHA,
            'g-recaptcha-response' => 'required',
        ],
        [
            'g-recaptcha-response.required' => 'Silakan verifikasi bahwa Anda bukan robot.',
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $body = json_decode((string)$response->body());

        if (!isset($body->success) || !$body->success) {
            // Jika verifikasi reCAPTCHA gagal
            throw ValidationException::withMessages([
                'g-recaptcha-response' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.',
            ]);
        }

        try {
            // Simpan data ke database menggunakan model Contact
            Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);

            // Redirect kembali dengan pesan sukses
            Session::flash('success', 'Pesan Anda telah berhasil dikirim!');
            return redirect()->back();
        } catch (\Exception $e) {
            // Tangani error jika terjadi
            Session::flash('error', 'Terjadi kesalahan saat mengirim pesan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    // Controller untuk team
    public function team(Request $request)
    {
        $team = User::where('role','author')->latest()->paginate(9);

        $categories = Category::all();
        $sidebar = Article::latest()->limit(5)->get();

        return view('home.page.team', compact('team', 'categories', 'sidebar'));
    }

    // Controller untuk about
    public function about()
    {
        return view('home.about.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
