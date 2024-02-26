<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Course;
use App\Models\Demostration;
use App\Models\Licence;
use App\Models\Quotation;
use Illuminate\Http\Request;

class RequestsController extends Controller
{
    public function demostration()
    {
        $demostrations = Demostration::orderByDesc('id')->get();
        return view('requests.demo',compact('demostrations'));
    }
    public function quotation()
    {
        $quotes = Quotation::orderByDesc('id')->get();
        return view('requests.quote',compact('quotes'));
    }
    public function careers()
    {
        $careers = Career::orderByDesc('id')->get();
        return view('requests.job',compact('careers'));
    }
    public function quote()
    {
        $trainings = Course::all();
        $licences = Licence::all();
        return view('request-forms.quote', compact('trainings', 'licences'));
    }
    public function storeQuote(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|min:3',
            'lname' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'position' => 'nullable',
            'company_name' => 'required',
            'comment' => 'nullable',
        ]);


        if ($request->has('training')) {
            $trainings = implode('_', $request->training);
        } else {
            $trainings = null;
        }

        $trainee_number = implode('_', $request->trainee_number);

        if ($request->has('licence')) {
            $licence = implode('_', $request->licence);
        } else {
            $licence = null;
        }

        $licence_number = implode('_', $request->licence_number);

        try {
            Quotation::create([
                'name' => $request->fname . ' ' . $request->lname,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'comments' => $request->comment,
                'position' => $request->position,
                'phone' => $request->phone,
                'trainings' => $trainings,
                'trainee_number' => $trainee_number,
                'licence' => $licence,
                'licence_number' => $licence_number
            ]);
            return back()->with('success', 'Your request sent succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            // dd($th->getMessage());
            return back()->with('error', $th->getMessage());
        }
    }
    public function demo()
    {
        return view('request-forms.demo');
    }

    public function storeDemo(Request $request)
    {
        $request->validate([
            'topic' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'position' => 'nullable',
            'company_name' => 'required',
            'suggest_date' => 'required',
            'comments' => 'nullable',
        ]);
        try {
            Demostration::create($request->all());
            return back()->with('success', 'Your request sent succesfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function job()
    {
        return view('request-forms.job');
    }
    public function storeJob(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|min:3',
            'lname' => 'required|string|min:3',
            'email' => 'required|email',
            'title' => 'required',
            'phone' => 'required|numeric',
            'cover_letter' => 'required',
            'cv_url' => 'required',
        ]);

        if ($request->hasFile('cv_url')) {
            $cv = $request->file('cv_url')->store('CV');
        }

        try {
            Career::create([
                'name' => $request->fname . ' ' . $request->lname,
                'email' => $request->email,
                'title' => $request->title,
                'cover_letter' => $request->cover_letter,
                'cv' => $cv,
                'phone' => $request->phone,
            ]);
            return back()->with('success', 'Your request sent succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            // dd($th->getMessage());
            return back()->with('error', $th->getMessage());
        }
    }
}
