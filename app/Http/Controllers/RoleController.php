<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission; 

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        DB::statement("SET SQL_MODE=''");
        $role_permission = Permission::select('name','id')->groupBy('name')->get();
    
        $custom_permission = array();
    
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
    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->name,
        ]);
    
        if($request->permissions){    
            foreach ($request->permissions as $key => $value) {
                $role->givePermissionTo($value);
            }
        }

        Alert::toast('Toast Message', 'success');
    
        return redirect()->route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::with('permissions')->find($id);

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
    public function update(Request $request, string $id)
    {
         
        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required'
        ]);

        $role->update([
            "name" => $request->name
        ]);

        $role->syncPermissions($request->permissions);

        Alert::toast('Toast Message', 'success');

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);

        if(isset($role)) {        
            
        $role->permissions()->detach();
        $role->delete();

        Alert::toast('Toast Message', 'success');
        return redirect()->route('roles.index');
        
        }
    }

}
