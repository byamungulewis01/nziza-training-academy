<?php

namespace App\Http\Controllers;

use App\Models\MonthlyGoal;
use App\Models\MonthlyGoalsList;
use Illuminate\Http\Request;

class MonthlyGoalsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $collection = MonthlyGoal::where('user_id',auth()->user()->id)->orderByDesc('month')->get();

        return view('reports.monthly', compact('collection'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('reports.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (count($request->type) < 5) {
            return back()->with('warning1', 'You must add at least 5 activities to do');
        }
        $request->validate([
            'type' => 'required|array|min:5',
            'quality' => 'required|array|min:5',
            'revenue' => 'required|array|min:5',
            'client_name' => 'required|array|min:5',
            'description' => 'required|array|min:5',
        ]);
        $nextMonth = now()->addMonth()->firstOfMonth()->format('Y-m-d');

        try {
            $monthly_goal = MonthlyGoal::create(['month' => $nextMonth, 'user_id' => auth()->user()->id]);
            if ($monthly_goal) {
                for ($i = 0; $i < count($request->type); $i++) {
                    MonthlyGoalsList::create([
                        'monthly_goal_id' => $monthly_goal->id,
                        'type' => $request->type[$i],
                        'quality' => $request->quality[$i],
                        'revenue' => $request->revenue[$i],
                        'client_name' => $request->client_name[$i],
                        'description' => $request->description[$i],
                    ]);
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            return to_route('monthly_goals.index')->with('error', 'Some error occurred while processing');
        }

        return back()->with('message', 'Create Succesfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $collection = MonthlyGoalsList::where('monthly_goal_id', $id)->get();
        return view('reports.show', compact('collection', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $collection = MonthlyGoalsList::where('monthly_goal_id', $id)->get();
        return view('reports.edit', compact('collection', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (count($request->type) < 5) {
            return back()->with('warning1', 'You must add at least 5 activities to do');
        }
        $request->validate([
            'type' => 'required|array|min:5',
            'quality' => 'required|array|min:5',
            'revenue' => 'required|array|min:5',
            'client_name' => 'required|array|min:5',
            'description' => 'required|array|min:5',
        ]);

        try {
            $monthly_goal = MonthlyGoalsList::where('monthly_goal_id', $id)->delete();
            if ($monthly_goal) {
                for ($i = 0; $i < count($request->type); $i++) {
                    MonthlyGoalsList::create([
                        'monthly_goal_id' => $id,
                        'type' => $request->type[$i],
                        'quality' => $request->quality[$i],
                        'revenue' => $request->revenue[$i],
                        'client_name' => $request->client_name[$i],
                        'description' => $request->description[$i],
                    ]);
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'Some error occurred while processing');

        }

        return back()->with('message', 'Updated Succesfully');
    }
    /**
     * update_revenues the specified resource in storage.
     */
    public function update_revenues(Request $request, string $id)
    {
        try {
            for ($i = 0; $i < count($request->id); $i++) {
                MonthlyGoalsList::findOrFail($request->id[$i])->update([
                    'achieves_revenue' => $request->revenue[$i]]);
            }

            return back()->with('message', 'Submited Succesfully');

        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'Some error occurred while processing');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            //code...
            MonthlyGoal::findOrFail($id)->delete();
            return back()->with('message', 'Delete Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'Some error occurred while processing');

        }
    }
}
