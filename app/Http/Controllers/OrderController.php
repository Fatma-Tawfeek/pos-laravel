<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:orders.view')->only('index');
        $this->middleware('permission:orders.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::whereHas('client', function ($q) use ($request) {
           return $q->where('name', 'like', '%' . $request->search . '%');
        })
        ->with('client')
        ->orderBy('id','desc')
        ->paginate();

        // Delete Confirmation        
        $title = trans('orders.delete_msg_title');
        $text = trans('orders.delete_msg_desc');
        Alert::confirmDelete($title, $text);        

        return view('orders.index', compact('orders'));
    }

    public function products(Order $order)
    {
        $products = $order->products;

        return view('orders._products', compact('products', 'order'));
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
