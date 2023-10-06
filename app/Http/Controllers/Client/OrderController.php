<?php

namespace App\Http\Controllers\Client;

use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('clients.orders.create', compact('client', 'categories', 'orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Client $client)
    {
        $request->validate([
            'products' => ['required', 'array'],
        ]);

        $this->attach_order($request, $client);
        
        Alert::toast('Toast Message', 'success');

        return redirect()->route('orders.index');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client, Order $order)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('clients.orders.edit', compact('client', 'order', 'categories', 'orders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client, Order $order)
    {
        $request->validate([
            'products' => ['required', 'array'],
        ]);

        $this->detach_order($order);

        $this->attach_order($request, $client);

        Alert::toast('Toast Message', 'success');

        return redirect()->route('orders.index');
    }

    private function attach_order(Request $request, Client $client)
    {
        $order = $client->orders()->create([]);

        $order->products()->attach($request->products);

        $total_price = 0;

        foreach ($request->products as $id => $quantity) {

            $product = Product::FindOrFail($id);
            $total_price += $product->sale_price * $quantity['quantity'];

            $product->update([
                'stock' => $product->stock - $quantity['quantity']
            ]);

        }

        $order->update([
            'total_price' => $total_price
        ]);

    }

    private function detach_order(Order $order)
    {
        foreach ($order->products as $product) {

            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);

        }
        $order->delete();
    }
}
