<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Information;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Information::query();

        // Filter: jika ada pencarian atau status
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $information = $query->orderBy('created_at', 'desc')->paginate(10); // <- ini penting

        return view('admin.informations.index', compact('information'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.informations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meta_desc' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'boolean',
        ]);

        Information::create([
            'title' => $request->title,
            'meta_desc' => $request->meta_desc,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'status' => $request->status ?? false,
        ]);

        return redirect()->route('admin.informations.index')->with('success', 'Information berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Information $information)
    {
        return view('admin.informations.show', compact('information'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Information $information)
{
    return view('admin.informations.edit', compact('information'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Information $information)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meta_desc' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'boolean',
        ]);

        $information->update([
            'title' => $request->title,
            'meta_desc' => $request->meta_desc,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'status' => $request->status ?? false,
        ]);

        return redirect()->route('admin.informations.index')->with('success', 'Information berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Information $information)
    {
        $information->delete();
        return redirect()->route('admin.informations.index')->with('success', 'Information berhasil dihapus.');
    }
}
