<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseSubscriber;
use App\Models\Trainee;
use Illuminate\Http\Request;

class TrainingSubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collections = CourseSubscriber::orderByDesc('id')->get();
        $trainees = Trainee::orderBy('name')->get();
        $courses = Course::orderBy('name')->get();
        return view('subscribers.courses', compact('collections', 'trainees', 'courses'));
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
            'trainee_id' => 'required',
            'course_id' => 'required',
            'duration' => 'required',
        ]);
        try {

            $duration = explode(' to ', $request->duration);
            CourseSubscriber::create([
                'trainee_id' => $request->trainee_id,
                'course_id' => $request->course_id,
                'start_date' => $duration[0],
                'end_date' => $duration[1],
            ]);

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
            'trainee_id' => 'required',
            'course_id' => 'required',
            'duration' => 'required',
        ]);
        try {
            $subscribe = CourseSubscriber::findOrFail($id);

            $duration = explode(' to ', $request->duration);
            $subscribe->update([
                'trainee_id' => $request->trainee_id,
                'course_id' => $request->course_id,
                'start_date' => $duration[0],
                'end_date' => $duration[1],
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
        CourseSubscriber::findOrFail($id)->delete();
        return back()->with('message', 'Deleted Succesfully');

    }
}
