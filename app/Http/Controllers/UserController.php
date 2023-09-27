<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\UploadFile;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

    use UploadFile;
    //use UploadFile;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $users = User::with('roles')
                ->where('name', 'LIKE', '%'. $request->search. '%')
                ->orWhere('email', 'LIKE', '%'. $request->search. '%')
                ->paginate(); 
        } else {

        $users = User::with('roles')
        ->orderBy('id', 'desc')
        ->paginate();
        }

        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        Alert::confirmDelete($title, $text);

        return view('users.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string', 'email', 'unique:users'],
            'password' => ['required','string','min:8', 'confirmed'],
            'role' => ['required', 'exists:roles,name'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
        ]);
        
        if($request->hasFile('image')) {
            $imageName = $this->uploadImage($request->image, User::IMAGE_PATH);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'image' => $imageName ?? 'default.png'
        ]);

        $user->assignRole($request->role);

        Alert::toast('Toast Message', 'success');

        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::get();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        
        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string', 'email', 'unique:users,email,'. $user->id],
            'password' => ['nullable','string','min:8', 'confirmed'],
            'role' => ['required', 'exists:roles,name'],
            'image' => ['nullable', 'image','mimes:jpeg,png,jpg','max:2048']
        ]);

        if($request->hasFile('image')) {
            $imageName = $this->uploadImage($request->image, User::IMAGE_PATH, $user->image);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'image' => $imageName ?? $user->image
        ]);

        $user->syncRoles($request->role);

        Alert::toast('Toast Message', 'success');

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Delete old image
        if($user->image != 'default.png') {
        $this->deleteImage($user->image, User::IMAGE_PATH);
        }

        $user->delete();

        Alert::toast('Toast Message', 'success');

        return redirect()->route('users.index');
    }
}
