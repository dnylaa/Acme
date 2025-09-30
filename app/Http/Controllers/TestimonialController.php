<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'message' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $data['user_id'] = auth()->id();
        $data['name'] = auth()->user()->name;

        $data['status'] = 'approved'; // Langsung approved, 

        Testimonial::create($data);

        return back()->with('success', 'Review berhasil dikirim.');
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        // Pastikan user hanya bisa update testimoni miliknya sendiri
        if ($testimonial->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
        }

        $data = $request->validate([
            'message' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

            $data['status'] = 'approved';

        $testimonial->update($data);

        return back()->with('success', 'Review berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $user = auth()->user();
        
        if ($testimonial->user_id !== $user->id && $user->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        
        $testimonial->delete();

        return redirect()->back()->with('success', 'Testimoni berhasil dihapus!');
    }
}
