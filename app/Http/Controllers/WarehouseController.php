<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreWarehouseRequest;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:warehouses.view')->only('index');
        $this->middleware('permission:warehouses.create')->only('create');
        $this->middleware('permission:warehouses.edit')->only('edit');
        $this->middleware('permission:warehouses.delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $warehouses = Warehouse::when($request->search, function ($q) use ($request) {
            return $q->where('name', 'LIKE', '%'. $request->search. '%');
        })
        ->orderBy('id', 'desc')
        ->paginate();

        $title = trans('warehouses.delete_msg_title');
        $text = trans('warehouses.delete_msg_desc');
        Alert::confirmDelete($title, $text);

        return view('warehouses.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('warehouses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWarehouseRequest $request)
    {
        warehouse::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        Alert::toast(trans('users.success_msg'), 'success');

        return redirect()->route('warehouses.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $warehouse)
    {
        return view('warehouses.edit', compact('warehouse'));        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreWarehouseRequest $request, Warehouse $warehouse)
    {
        $warehouse->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        Alert::toast(trans('users.success_msg'), 'success');

        return redirect()->route('warehouses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();

        Alert::toast(trans('users.success_msg'), 'success');

        return redirect()->route('warehouses.index');

    }
}
