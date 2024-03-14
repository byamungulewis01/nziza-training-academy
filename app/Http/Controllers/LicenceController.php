<?php

namespace App\Http\Controllers;

use App\Models\Licence;
use Illuminate\Http\Request;

class LicenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $licences = Licence::orderByDesc('id')->get();
        return view('license.index', compact('licences'));
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
        $request->validate(['name' => 'required|unique:licences,name', 'price' => 'required|numeric', 'licence_type' => 'required']);
        try {
            Licence::create($request->all());
            return back()->with('message', 'Licence Added Succesfully');
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
        $request->validate(['name' => 'required|unique:licences,name,' . $id,'price' => 'required|numeric', 'licence_type' => 'required']);
        try {
            Licence::findorfail($id)->update($request->all());
            return back()->with('message', 'Licence Updated Succesfully');
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
            Licence::findorfail($id)->delete();
            return back()->with('message', 'Licence Added Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }
}
