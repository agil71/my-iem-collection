<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(private CartService $cart) {}

    public function index(): View
    {
        $items = $this->cart->items();
        $total = $this->cart->total();
        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request, string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $qty = (int) $request->input('qty', 1);

        if ($product->stock < $qty) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi!');
        }

        $this->cart->add($product, $qty);

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function remove(string $id): RedirectResponse
    {
        $this->cart->remove($id);
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang!');
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $qty = (int) $request->input('qty', 1);
        $this->cart->update($id, $qty);
        return redirect()->back();
    }

    public function clear(): RedirectResponse
    {
        $this->cart->clear();
        return redirect()->route('cart.index')->with('success', 'Keranjang dikosongkan!');
    }

    public function checkout(): View
    {
        $items = $this->cart->items();
        $total = $this->cart->total();
        
        if (empty($items)) {
            return redirect()->route('cart.index');
        }

        return view('cart.checkout', compact('items', 'total'));
    }

    public function processCheckout(Request $request): RedirectResponse
    {
        $items = $this->cart->items();
        
        if (empty($items)) {
            return redirect()->route('products.index')->with('error', 'Keranjang kosong!');
        }

        $request->validate([
            'name' => 'required|min:3',
            'phone' => 'required|min:10',
            'address' => 'required|min:10',
        ]);

        // Create order data
        $order = [
            'order_id' => 'IEM-' . strtoupper(uniqid()),
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'notes' => $request->notes,
            'items' => $items,
            'total' => $this->cart->total(),
            'date' => now()->format('d/m/Y H:i'),
        ];

        // Decrease stock for each item
        foreach ($items as $item) {
            $product = Product::find($item['product_id']);
            if ($product && $product->stock >= $item['qty']) {
                $product->decrement('stock', $item['qty']);
            }
        }

        $this->cart->clear();

        // Store order in session for confirmation page
        session(['last_order' => $order]);

        return redirect()->route('order.confirmation');
    }

    public function orderConfirmation()
    {
        $order = session('last_order');
        
        if (!$order) {
            return redirect()->route('home');
        }

        return view('cart.confirmation', compact('order'));
    }
}