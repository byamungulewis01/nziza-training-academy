<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Course;
use App\Models\Licence;
use App\Models\Quotation;
use App\Models\Demostration;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RequestsController extends Controller
{
    public function demostration()
    {
        $demostrations = Demostration::orderByDesc('id')->get();
        return view('requests.demo', compact('demostrations'));
    }
    public function quotation()
    {
        $quotes = Quotation::orderByDesc('id')->get();
        return view('quotation.index', compact('quotes'));
    }
    public function create()
    {
        return view('quotation.create');
    }
    public function edit($id)
    {
        $quote = Quotation::findorfail($id);
        return view('quotation.edit', compact('quote'));
    }
    public function download($id)
    {
        $invoice = Quotation::findorfail($id);
        $pdf = Pdf::loadView('quotation.pdf', compact('invoice'))->setPaper('a4', 'landscape');
        return $pdf->stream(time() . '.pdf');
        // return view('quotation.pdf',compact('invoice'));
    }
    public function show($id)
    {
        $invoice = Quotation::findOrFail($id);
        return view('quotation.show', compact('invoice'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fname' => 'required|string|min:3',
            'lname' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'position' => 'nullable',
            'company_name' => 'required',
        ]);

        $request->merge([
            'name' => $request->fname . ' ' . $request->lname,
        ]);

        if ($request->has('training')) {

            $request->merge([
                'training' => implode('_', $request->training),
                'training_qty' => implode('_', $request->training_qty),
            ]);
        }
        if ($request->has('licence')) {
            $request->merge([
                'licence' => implode('_', $request->licence),
                'licence_qty' => implode('_', $request->licence_qty),
            ]);
        }
        if ($request->comments != null) {
            $request->merge(['comments' => $request->comments]);
        } else {
            $request->merge(['comments' => Quotation::findOrFail($id)->comments]);
        }
        try {
            Quotation::findOrFail($id)->update($request->all());
            return back()->with('message', 'Quotation update succesfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function destroy($id)
    {
        Quotation::find($id)->delete();
        return back()->with('message', 'Quotation Deleted successfully');
    }
    public function careers()
    {
        $careers = Career::orderByDesc('id')->get();
        return view('requests.job', compact('careers'));
    }
    public function quote()
    {
        $trainings = Course::all();
        $licences = Licence::all();
        return view('request-forms.quote', compact('trainings', 'licences'));
    }
    public function storeQuote(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'fname' => 'required|string|min:3',
            'lname' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'position' => 'nullable',
            'company_name' => 'required',
            'comments' => 'nullable',
        ]);

        $request->merge([
            'name' => $request->fname . ' ' . $request->lname,
        ]);

        if ($request->has('training')) {

            $request->merge([
                'training' => implode('_', $request->training),
                'training_qty' => implode('_', $request->training_qty),
            ]);
        }
        if ($request->has('licence')) {
            $request->merge([
                'licence' => implode('_', $request->licence),
                'licence_qty' => implode('_', $request->licence_qty),
            ]);
        }

        try {
            Quotation::create($request->all());
            return back()->with('message', 'Quotation sent succesfully');
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
