<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\LicenseSubscriber;
use Illuminate\Http\Request;

class LicenseSubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collections = LicenseSubscriber::orderByDesc('id')->get();
        $clients = Client::orderBy('name')->get();
        return view('subscribers.licenses', compact('collections', 'clients'));
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
            'client_id' => 'required',
            'description' => 'required|string|max:255',
            'duration' => 'required',
            'file' => 'required|mimes:pdf,docx,|max:30000',
        ]);
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = $file->getClientOriginalName();
                $path_url = date('His') . '-' . $filename;
            }
            $duration = explode(' to ', $request->duration);
            $instence = LicenseSubscriber::create([
                'client_id' => $request->client_id,
                'description' => $request->description,
                'start_date' => $duration[0],
                'end_date' => $duration[1],
                'contract_file_url' => $path_url,
            ]);
            if ($instence) {
                $file->move(public_path('files/contracts'), $path_url);
            }
            return back()->with('message', 'Registered Succesfully');
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
            'client_id' => 'required',
            'description' => 'required|string|max:255',
            'duration' => 'required',
            'file' => 'sometimes|mimes:pdf,docx,|max:30000',
        ]);
        try {
            $subscribe = LicenseSubscriber::findOrFail($id);
            $path_url = $subscribe->contract_file_url;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = $file->getClientOriginalName();
                $path_url = date('His') . '-' . $filename;
                $file->move(public_path('files/contracts'), $path_url);

            }
            $duration = explode(' to ', $request->duration);
            $subscribe->update([
                'client_id' => $request->client_id,
                'description' => $request->description,
                'start_date' => $duration[0],
                'end_date' => $duration[1],
                'contract_file_url' => $path_url,
            ]);

            return back()->with('message', 'Updated Succesfully');
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
        LicenseSubscriber::findOrFail($id)->delete();
        return back()->with('message', 'Deleted Succesfully');

    }
}
