<?php

namespace App\Http\Controllers;

use App\Models\DairlyReport;
use Illuminate\Http\Request;

class DairlyReportController extends Controller
{
    //
    public function index()
    {
        $report = DairlyReport::where('reported_by', auth()->user()->id)->whereDate('created_at', now())->first();
        return view('reports.index', compact('report'));
    }
    public function report(Request $request)
    {
        $request->merge(['reported_by' => auth()->user()->id]);
        try {
            $report = DairlyReport::where('reported_by', auth()->user()->id)
                ->whereDate('created_at', now())
                ->first();

            if ($report) {
                if ($request->beforenoon == null) {
                    $request->merge(['beforenoon' => $report->beforenoon]);
                }
                if ($request->afternoon == null) {
                    $request->merge(['afternoon' => $report->afternoon]);
                }
                $report->update($request->all());
            } else {
                DairlyReport::create($request->all());
            }
            return back()->with('message', 'Reported Succesfully');

        } catch (\Throwable $e) {
            return back()->with('error', 'An error occurred while processing your request.');
        }
    }
}
