<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DairlyReport;
use Illuminate\Http\Request;

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
}
