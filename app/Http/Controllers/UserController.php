<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();
        $employees = User::all();
        return view('employees.index', compact('branches', 'employees'));
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
        $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|unique:users,phone',
            'image' => 'required|mimes:png,jpg,jpeg,svg,gif|max:100000',
            'position' => 'required',
            'status' => 'required',
            'role' => 'required',
            'branch_id' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $profile = $request->file('image')->store('profile');
        }
        $request->merge([
            'profile' => $profile,
            'password' => 'password'
        ]);
        try {
            User::create($request->all());
            return back()->with('success', 'Employee Added Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            // dd($th->getMessage());
            return back()->with('error', $th->getMessage());
        }
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
        $user = User::where('id', $id)->first();
        $profile = $user->profile;
        $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|numeric|unique:users,phone,'.$id,
            'image' => 'nullable|mimes:png,jpg,jpeg,svg,gif|max:100000',
            'position' => 'required',
            'status' => 'required',
            'role' => 'required',
            'branch_id' => 'required',
        ]);
        if ($request->hasFile('image')) {
            Storage::delete($user->profile);
            $profile = $request->file('image')->store('profile');
        }
        $request->merge([
            'profile' => $profile,
            'password' => 'password'
        ]);
        try {
            User::create($request->all());
            return back()->with('success', 'Employee Added Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            // dd($th->getMessage());
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
