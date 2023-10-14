<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission; 

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:roles.view')->only('index');
        $this->middleware('permission:roles.create')->only('create');
        $this->middleware('permission:roles.edit')->only('edit');
        $this->middleware('permission:roles.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        $roles = Role::
        orderBy('id', 'desc')
        ->get();

        // Delete confirmation        
        $title = trans('roles.delete_msg_title');
        $text = trans('roles.delete_msg_desc');
        Alert::confirmDelete($title, $text);

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        DB::statement("SET SQL_MODE=''");
        $role_permission = Permission::select('name','id')->groupBy('name')->get();
    
        $custom_permission = [];
    
        foreach($role_permission as $per){
    
            $key = substr($per->name, 0, strpos($per->name, "."));
    
            if(str_starts_with($per->name, $key)){
             
                $custom_permission[$key][] = $per;
            }
    
        }
     
        return view('roles.create')->with('permissions',$custom_permission);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $request->validate([
           
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);
    
        if($request->permissions){    
            foreach ($request->permissions as $key => $value) {
                $role->givePermissionTo($value);
            }
        }

        Alert::toast(trans('users.success_msg'), 'success');
    
        return redirect()->route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $role = Role::with('permissions')->find($role->id);

        DB::statement("SET SQL_MODE=''");
        $role_permission = Permission::select('name','id')->groupBy('name')->get();


        $custom_permission = array();

        foreach($role_permission as $per){

            $key = substr($per->name, 0, strpos($per->name, "."));

            if(str_starts_with($per->name, $key)){
                $custom_permission[$key][] = $per;
            }

        }

        return view('roles.edit', compact('role'))->with('permissions',$custom_permission);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update([
            "name" => $request->name
        ]);

        $role->syncPermissions($request->permissions);

        Alert::toast(trans('users.success_msg'), 'success');

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if(isset($role)) {        
            
        $role->permissions()->detach();
        $role->delete();

        Alert::toast(trans('users.success_msg'), 'success');
        return redirect()->route('roles.index');
        
        }
    }

}
