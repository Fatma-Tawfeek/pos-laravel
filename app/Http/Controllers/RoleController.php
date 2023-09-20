<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission; 

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        DB::statement("SET SQL_MODE=''");;
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
    public function destroy(string $id)
    {
        //
    }
}
