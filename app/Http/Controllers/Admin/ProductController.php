<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['user', 'productType'])->latest();

        $user = Auth::user();
        if ($user && $user->isAuthor()) {
            $query->where('user_id', $user->id);
        }

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->has('status')) {
            $status = filter_var($request->status, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            if ($status !== null) {
                $query->where('status', $status);
            }
        }

        $products = $query->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $productTypes = ProductType::all();
        return view('admin.products.create', compact('productTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sku' => 'required|string|unique:products',
            'product_type_id' => 'required|exists:product_types,id',
            'meta_desc' => 'required|string|max:255',
            'content' => 'required|string',
            'how_to_use' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'status' => 'nullable|boolean',
            'stock' => 'required|integer|min:0',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'user_id' => Auth::id(),
            'product_type_id' => $request->product_type_id,
            'title' => $request->title,
            'sku' => $request->sku,
            'meta_desc' => $request->meta_desc,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'how_to_use' => $request->how_to_use,
            'ingredients' => $request->ingredients,
            'image' => $imagePath,
            'price' => $request->price,
            'discount' => $request->discount,
            'stock' => $request->stock,
            'status' => $request->boolean('status', false),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dibuat.');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $user = Auth::user();
        if ($user->id !== $product->user_id && !$user->isAdmin()) {
            abort(403);
        }

        $productTypes = ProductType::all();

        return view('admin.products.edit', compact('product', 'productTypes'));
    }

    public function update(Request $request, Product $product)
    {
        $user = Auth::user();
        if ($user->id !== $product->user_id && !$user->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'meta_desc' => 'required|string|max:255',
            'product_type_id' => 'required|exists:product_types,id',
            'content' => 'required|string',
            'how_to_use' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'price' => 'required|string',
            'discount' =>  'nullable|numeric|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        } elseif ($request->input('remove_image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
                $imagePath = null;
            }
        }

        $product->update([
            'user_id' => Auth::id(),
            'product_type_id' => $request->product_type_id,
            'title' => $request->title,
            'sku' => $request->sku,
            'meta_desc' => $request->meta_desc,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'how_to_use' => $request->how_to_use,
            'ingredients' => $request->ingredients,
            'image' => $imagePath,
            'price' => $request->price,
            'discount' => $request->discount,
            'stock' => $request->stock,
            'status' => $request->boolean('status', false),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $user = Auth::user();
        if ($user->id !== $product->user_id && !$user->isAdmin()) {
            abort(403);
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    // Tambahan untuk frontend (user lihat produk)
public function frontendIndex(Request $request)
{
    $query = Product::query();

    // Search
    if ($request->has('search') && $request->search != '') {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    // Filter kategori khusus (contoh: terbaru, terlaris, diskon)
    if ($request->filter == 'terbaru') {
        $query->orderBy('created_at', 'desc');
    } elseif ($request->filter == 'terlaris') {
        $query->orderBy('sold', 'desc'); // pastikan kamu punya kolom 'sold'
    } elseif ($request->filter == 'diskon') {
        $query->where('discount', '>', 0);
    } elseif ($request->filter == 'harga_asc') {
        $query->orderBy('price', 'asc');
    } elseif ($request->filter == 'harga_desc') {
        $query->orderBy('price', 'desc');
    } elseif ($request->filter == 'az') {
        $query->orderBy('title', 'asc');
    }

    $products = $query->paginate(9);
    $productTypes = ProductType::all();

    return view('home.product.index', compact('products', 'productTypes'));
}

// Detail produk frontend
public function frontendShow(Product $product)
{
    $productTypes = ProductType::all();
    return view('home.product.show', compact('product', 'productTypes'));
}

}
