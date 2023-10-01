<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        Alert::confirmDelete($title, $text); 

        $clients = Client::when($request->search, function($q) use ($request) {

            return $q->where('name', 'like', '%' . $request->search . '%')
            ->orWhere('phone', 'like', '%' . $request->search . '%')
            ->orWhere('address', 'like', '%' . $request->search . '%');
        })
        ->orderBy('id', 'desc')
        ->paginate();

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
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'array'],
            'phone.0' => ['required'],
            'address' => ['required', 'string']
        ]);

        Client::create($request->all());

        Alert::toast('Success', 'Success');

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
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'array'],
            'phone.0' => ['required'],
            'address' => ['required', 'string']
        ]);

        $client->update($request->all());

        Alert::toast('Success', 'Success');

        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        Alert::toast('Success', 'Success');

        return redirect()->route('clients.index');
    }
}
