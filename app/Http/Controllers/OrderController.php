<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        Alert::confirmDelete($title, $text);
        
        $orders = Order::whereHas('client', function ($q) use ($request) {
           return $q->where('name', 'like', '%' . $request->search . '%');
        })
        ->with('client')
        ->orderBy('id','desc')
        ->paginate();

        return view('orders.index', compact('orders'));
    }

    public function products(Order $order)
    {
        $products = $order->products;

        return view('orders._products', compact('products', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        foreach ($order->products as $product) {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        }
        $order->delete();
        Alert::toast('Toast Message', 'success');
        return redirect()->route('orders.index');
    }
}
