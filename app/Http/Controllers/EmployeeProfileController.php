<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MonthlyGoal;
use App\Models\DairlyReport;
use Illuminate\Http\Request;
use App\Models\MonthlyGoalsList;

class EmployeeProfileController extends Controller
{
    //
    public function profile($id)
    {
        $employee = User::findOrFail($id);
        return view('employees.profile', compact('employee','id'));
    }
    public function reports($id)
    {
        $events = array();
        $reports = DairlyReport::all();

        foreach ($reports as $report) {

            $events[] = [
                'id' => $report->id,
                'title' => $report->title,
                'description' => $report->description,
                'start' => $report->created_at,
                'end' => $report->created_at,
            ];
        }
        return view('employees.reports', compact('events','id'));
    }
    public function monthly_reports($id)
    {
        $collection = MonthlyGoal::where('user_id',$id)->orderByDesc('month')->get();
        return view('employees.monthly_reports', compact('collection','id'));
    }
    public function monthly_reports_review($id,$goal)
    {
        $collection = MonthlyGoalsList::where('monthly_goal_id', $goal)->get();
        return view('employees.monthly_reports_review', compact('collection','id'));
    }
}
