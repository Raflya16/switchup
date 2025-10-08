<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        
        $query = \App\Models\Item::with(['user.ratingsReceived', 'category']);

        $query->where('status', 'available');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        if (auth()->check()) {
            $query->where('user_id', '!=', auth()->id());
        }
        
        $items = $query->latest()->paginate(12);

        return view('items.index', compact('items', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $token = Str::random(40);
        session()->put('form_token', $token);

        $categories = Category::all();
        return view('items.create', compact('categories', 'token'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (session()->get('form_token') !== $request->form_token) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
        session()->forget('form_token');
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = $request->file('image')->store('items', 'public');

        $item = Item::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $galleryPath = $file->store('items/gallery', 'public');
                ItemImage::create([
                    'item_id' => $item->id,
                    'path' => $galleryPath
                ]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        $item->load('images', 'user.ratingsReceived'); // <-- Nama yang benar

        $userItems = auth()->check() ? Auth::user()->items()->where('status', 'available')->get() : collect();

        return view('items.show', compact('item', 'userItems'));
    }
    
    public function edit(Item $item)
    {
        if (Auth::id() !== $item->user_id) {
            abort(403, 'AKSES DITOLAK');
        }
        
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        if (Auth::id() !== $item->user_id) {
            abort(403, 'AKSES DITOLAK');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id', // Tambahkan validasi kategori
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $data['image'] = $request->file('image')->store('items', 'public');
        }

        $item->update($data);

        return redirect()->route('dashboard')->with('success', 'Barang berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        if (Auth::id() !== $item->user_id) {
            abort(403, 'AKSES DITOLAK');
        }

        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        // Hapus juga gambar dari galeri
        foreach($item->images as $galleryImage) {
            Storage::disk('public')->delete($galleryImage->path);
        }

        $item->delete();

        return redirect()->route('dashboard')->with('success', 'Barang berhasil dihapus!');
    }
}