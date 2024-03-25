<?php

namespace App\Http\Controllers;

use App\Models\DairlyReport;
use Illuminate\Http\Request;

class DairlyReportController extends Controller
{
    //
    public function index()
    {
        $events = array();
        $reports = DairlyReport::all();

        foreach ($reports as $report) {

            $events[] = [
                'id' => $report->id,
                'title' => $report->title,
                'description' => $report->description,
                'comment' => $report->comment,
                'start' => $report->created_at,
                'end' => $report->created_at,
                'color' => ($report->comment) ? '#fc0000' : ''
            ];
        }
        return view('reports.index', compact('events'));
    }
    public function report(Request $request)
    {
        $request->validate([
            'reported_by' => 'required',
            'title' => 'required|string',
            'description' => 'required',
        ]);

        $report = DairlyReport::create($request->all());
        if ($report) {
            return response()->json([
                'id' => $report->id,
                'start' => $report->created_at,
                'end' => $report->created_at,
                'title' => $report->title,
                'description' => $report->description,
                'color' => '#924ACE',
            ]);
        }

    }
    public function report_update(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required',
        ]);

        $report = DairlyReport::find($request->id);
        $report->update($request->all());
        return response()->json([
            'id' => $report->id,
            'start' => $report->created_at,
            'end' => $report->created_at,
            'title' => $report->title,
            'description' => $report->description,
            'color' => '#324ACE',
        ]);

    }
    public function report_comment(Request $request)
    {
        $request->validate([
            'commented_by' => 'required',
            'comment' => 'required',
        ]);
        $report = DairlyReport::find($request->id);
        $report->update($request->all());
        return response()->json([
            'id' => $report->id,
            'start' => $report->created_at,
            'end' => $report->created_at,
            'title' => $report->title,
            'description' => $report->description,
            'color' => '#fc0000',
        ]);

    }
    public function report_destroy($id)
    {

         DairlyReport::find($id)->delete();

        return $id;
    }
}
