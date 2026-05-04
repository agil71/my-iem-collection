<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * index: Halaman publik — semua orang bisa lihat
     */
    public function index(Request $request): View
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('sound_signature')) {
            $query->where('sound_signature', $request->sound_signature);
        }

        if ($request->filled('price_range')) {
            $range = explode('-', $request->price_range);
            if (count($range) === 2) {
                $query->whereBetween('price', [(int)$range[0], (int)$range[1]]);
            }
        }

        $products = $query->latest()->paginate(12)->appends($request->query());
        $isAdmin  = auth()->check() && auth()->user()->isAdmin();

        // Pass products as JSON untuk modal (tanpa frequency_data)
        $productsData = Product::select('id', 'title', 'image', 'price', 'stock', 'description', 'sound_signature')
            ->get()
            ->toArray();

        // Hapus frequency_data dari array jika ada
        foreach ($productsData as &$p) {
            unset($p['frequency_data']);
            $p['description'] = strip_tags($p['description'] ?? '');
        }

        $productsData = collect($productsData);

        return view('products.index', compact('products', 'isAdmin', 'productsData'));
    }

    /**
     * show: Detail publik
     */
    public function show(string $id): View
    {
        $product = Product::findOrFail($id);
        $isAdmin = auth()->check() && auth()->user()->isAdmin();

        return view('products.show', compact('product', 'isAdmin'));
    }

    /**
     * create: Hanya admin (dijaga middleware)
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * store: Hanya admin
     */
    public function store(Request $request): RedirectResponse
    {
$request->validate([
            'image'       => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'       => 'required|min:5',
            'description' => 'required|min:10',
            'price'       => 'required|numeric',
            'stock'       => 'required|numeric',
        ]);

        $image = $request->file('image');
        $image->storeAs('products', $image->hashName(), 'public');

        Product::create([
            'user_id'     => auth()->id(),
            'image'       => $image->hashName(),
            'title'       => $request->title,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'sound_signature' => $request->sound_signature ?? 'Balanced',
            'frequency_data'  => $request->frequency_data ?: null,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'IEM berhasil ditambahkan!');
    }

    /**
     * edit: Hanya admin
     */
    public function edit(string $id): View
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * update: Hanya admin
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'image'       => 'image|mimes:jpeg,jpg,png|max:2048',
            'title'       => 'required|min:5',
            'description' => 'required|min:10',
            'price'       => 'required|numeric',
            'stock'       => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete('products/' . $product->image);
            $image = $request->file('image');
            $image->storeAs('products', $image->hashName(), 'public');

            $product->update([
                'image'         => $image->hashName(),
                'title'         => $request->title,
                'description'   => $request->description,
                'price'        => $request->price,
                'stock'       => $request->stock,
                'sound_signature' => $request->sound_signature,
                'frequency_data'  => $request->frequency_data,
            ]);
        } else {
            $product->update([
                'title'         => $request->title,
                'description'   => $request->description,
                'price'        => $request->price,
                'stock'       => $request->stock,
                'sound_signature' => $request->sound_signature,
                'frequency_data'  => $request->frequency_data,
            ]);
        }

        return redirect()->route('products.index')
            ->with('success', 'IEM berhasil diperbarui!');
    }

    /**
     * destroy: Hanya admin
     */
    public function destroy($id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        Storage::disk('public')->delete('products/' . $product->image);
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'IEM berhasil dihapus!');
    }
}