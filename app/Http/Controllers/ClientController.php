<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:clients.view')->only('index');
        $this->middleware('permission:clients.create')->only('create');
        $this->middleware('permission:clients.edit')->only('edit');
        $this->middleware('permission:clients.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clients = Client::when($request->search, function($q) use ($request) {

            return $q->where('name', 'like', '%' . $request->search . '%')
            ->orWhere('phone', 'like', '%' . $request->search . '%')
            ->orWhere('address', 'like', '%' . $request->search . '%');
        })
        ->orderBy('id', 'desc')
        ->paginate();

        // Delete confirmation
        $title = trans('clients.delete_msg_title');
        $text = trans('clients.delete_msg_desc');
        Alert::confirmDelete($title, $text); 

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        Client::create($request->all());

        Alert::toast(trans('users.success_msg'), 'success');

        return redirect()->route('clients.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreClientRequest $request, Client $client)
    {
        $client->update($request->all());

        Alert::toast(trans('users.success_msg'), 'success');

        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        Alert::toast(trans('users.success_msg'), 'success');

        return redirect()->route('clients.index');
    }
}
