<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\ValidationException;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::where('guard_name','web')->with('users')->get();
        $user = User::all();
        $permissions = Permission::all();

        return view('settings.roles', compact('roles','user','permissions'));
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

        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
            'express' => 'required'
        ]);

        $express = $request->express;
        $permission = array_keys($request->get('permission'));

        if(!$express)
        {
            $name = Role::where('name',$request->name)->first();
            if($name){
                throw ValidationException::withMessages([
                    'name' => 'The name has already been taken.'
                ]);
            }
            $role = Role::create(['name' => $request->get('name')]);
            $role->syncPermissions($permission);

            return back()->with('message','Role created successfully');
        }
        else{
            $role=Role::findorfail($express);
            $role->update($request->only('name'));
            $role->syncPermissions($permission);

            return back()->with('message','Role updated successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required'
        ]);
        dd($request->all(), $role);
        $role->update($request->only('name'));
        $role->syncPermissions($request->get('permission'));

        return back()->with('message','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
