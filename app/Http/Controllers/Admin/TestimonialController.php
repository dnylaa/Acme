<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Tampilkan semua testimonial.
     */
    public function index()
    {
        // Bisa filter berdasarkan status
        $testimonials = Testimonial::latest()->paginate(10);

        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Tampilkan detail testimonial.
     */
    public function show($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.show', compact('testimonial'));
    }

    public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'message' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    $testimonial = new \App\Models\Testimonial();
    $testimonial->user_id = auth()->id();
    $testimonial->product_id = $request->product_id;
    $testimonial->name = auth()->user()->name;
    $testimonial->message = $request->message;
    $testimonial->rating = $request->rating;
    $testimonial->status = 'approved'; 
     

    $testimonial->save();

    return back()->with('success', 'Review kamu berhasil ditambahkan!');
}


    /**
     * Update status testimonial (approve/reject).
     */
    public function updateStatus(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $request->validate([
            'status' => 'required|in:approved',
        ]);

        $testimonial->status = $request->status;
        $testimonial->save();

        return redirect()->route('admin.testimonials.index')->with('success', 'Status testimonial berhasil diperbarui.');
    }


    /**
     * Hapus testimonial.
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial berhasil dihapus.');
    }
}
