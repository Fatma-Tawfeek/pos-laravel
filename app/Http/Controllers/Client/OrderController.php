<?php

namespace App\Http\Controllers\Client;

use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:orders.create')->only('create');
        $this->middleware('permission:orders.edit')->only('edit');
    }

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
    public function store(StoreOrderRequest $request, Client $client)
    {
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
    public function update(StoreOrderRequest $request, Client $client, Order $order)
    {
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
