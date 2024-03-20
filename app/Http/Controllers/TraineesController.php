<?php

namespace App\Http\Controllers;

use App\Models\Trainee;
use Illuminate\Http\Request;

class TraineesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainees = Trainee::orderByDesc('id')->get();
        return view('trainees.index', compact('trainees'));
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
            'name' => 'required|unique:trainees,name',
            'email' => 'required|email|unique:trainees,email',
            'phone' => 'required|unique:trainees,phone',
            'address' => 'required|string',
        ]);
        try {
            Trainee::create($request->all());
            return back()->with('message', 'Trainee Added Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
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
        $request->validate([
            'name' => 'required|unique:trainees,name,' . $id,
            'email' => 'required|email|unique:trainees,email,' . $id,
            'phone' => 'required|unique:trainees,phone,' . $id,
            'address' => 'required|string',
        ]);
        try {
            Trainee::findorfail($id)->update($request->all());
            return back()->with('message', 'Trainee Updated Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Trainee::findorfail($id)->delete();
            return back()->with('message', 'Trainee Deleted Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }
}
