<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
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
        $users = User::when($request->search, function($q) use ($request) {
            return $q->where('name', 'LIKE', '%'. $request->search. '%')
                     ->orWhere('email', 'LIKE', '%'. $request->search. '%');
        })
        ->orderBy('id', 'desc')
        ->paginate();

        // confirm delete
        $title = trans('users.delete_msg_title');
        $text = trans('users.delete_msg_desc');
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
    public function store(StoreUserRequest $request)
    {
        
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

        Alert::toast(trans('users.success_msg'), 'success');

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
    public function update(UpdateUserRequest $request, User $user)
    {
        if($request->hasFile('image')) {
            $imageName = $this->uploadImage($request->image, User::IMAGE_PATH, $user->image);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password) ?? $user->password,
            'image' => $imageName ?? $user->image
        ]);

        $user->syncRoles($request->role);

        Alert::toast(trans('users.success_msg'), 'success');

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

        Alert::toast(trans('users.success_msg'), 'success');

        return redirect()->route('users.index');
    }
}
