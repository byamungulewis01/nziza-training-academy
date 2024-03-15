<?php

namespace App\Http\Controllers;

use App\Mail\NewUser;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();
        $employees = User::where('role', '!=', 'super_admin')->orderByDesc('id')->get();
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
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $profile = date('His') . '-' . $filename;
            $file->move(public_path('images/profile'), $profile);
        } else {
            $profile = null;
        }

        $password = Str::random(6);
        $request->merge([
            'profile' => $profile,
            'password' => $password,
        ]);
        try {
            User::create($request->all());
            Mail::to($request->email)->send(new NewUser($request->email, $password));
            return back()->with('success', 'Employee Added Succesfully');
        } catch (\Throwable $th) {
            return back()->with('error', "Email Not Sent " . $th->getMessage());
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
        $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|numeric|unique:users,phone,' . $id,
            'image' => 'required|mimes:png,jpg,jpeg,svg,gif|max:100000',
            'position' => 'required',
            'status' => 'required',
            'role' => 'required',
            'branch_id' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $profile = date('His') . '-' . $filename;
            $file->move(public_path('images/profile'), $profile);
            $request->merge(['profile' => $profile]);
        }

        try {
            User::findOrFail($id)->update($request->all());
            return back()->with('success', 'Employee Updated Succesfully');
        } catch (\Throwable $th) {
            return back()->with('error', "Some thing went wrong" . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            User::findOrFail($id)->delete();
            return back()->with('success', 'Employee Deleted Succesfully');
        } catch (\Throwable $th) {
            return back()->with('error', "Some thing went wrong" . $th->getMessage());
        }
    }
}
