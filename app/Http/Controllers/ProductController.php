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
    public function index(): View
    {
        $products = Product::latest()->paginate(12);
        $isAdmin  = auth()->check() && auth()->user()->isAdmin();

        return view('products.index', compact('products', 'isAdmin'));
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
                'image'       => $image->hashName(),
                'title'       => $request->title,
                'description' => $request->description,
                'price'       => $request->price,
                'stock'       => $request->stock,
            ]);
        } else {
            $product->update([
                'title'       => $request->title,
                'description' => $request->description,
                'price'       => $request->price,
                'stock'       => $request->stock,
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