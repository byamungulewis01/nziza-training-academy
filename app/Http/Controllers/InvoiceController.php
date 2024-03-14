<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceEmail;
use App\Models\Client;
use App\Models\Course;
use App\Models\Invoice;
use App\Models\Licence;
use App\Models\Quotation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $invoices = Invoice::where('branch', 'rwanda')->orderByDesc('id')->get();

        return view('invoices.index', compact('invoices'));

    }
    public function index_tz()
    {
        //
        $invoices = Invoice::where('branch', 'tanzania')->orderByDesc('id')->get();

        return view('invoices-tz.index', compact('invoices'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::orderBy('name')->get();
        return view('invoices.create', compact('clients'));

    }
    public function quotation_invoice($id)
    {
        $invoice = Quotation::findOrFail($id);
        $clients = Client::orderBy('name')->get();
        return view('invoices.quotation', compact('clients','invoice'));

    }
    public function trainings()
    {
        return Course::orderBy('name')->get();

    }
    public function licenses()
    {
        return Licence::orderBy('name')->get();

    }
    public function create_tz()
    {
        //
        $trainings = Course::all();
        $licences = Licence::all();
        return view('invoices-tz.create', compact('trainings', 'licences'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'valid_date' => 'required',
            'expired_date' => 'required',
            'notes' => 'required',
            'client_id' => 'required',
            'invoice_no' => 'required',
            'branch' => 'required',
            'status' => 'required',
        ]);

        if (!$request->has('training') && !$request->has('licence')) {
            return back()->with('warning1', 'You must select Atleast one training or one License');
        }

        if ($request->has('training')) {

            $request->merge([
                'training' => implode('_', $request->training),
                'training_qty' => implode('_', $request->training_qty),
                'training_discount' => implode('_', $request->training_discount),
            ]);

        }
        if ($request->has('licence')) {
            $request->merge([
                'licence' => implode('_', $request->licence),
                'licence_qty' => implode('_', $request->licence_qty),
                'licence_discount' => implode('_', $request->licence_discount),
            ]);

        }

        try {
            Invoice::create($request->all());
            return back()->with('message', 'Invoice created successfully');

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
        $invoice = Invoice::findorfail($id);

        return view('invoices.show', compact('invoice'));
    }
    public function show_tz(string $id)
    {
        $invoice = Invoice::findorfail($id);

        return view('invoices-tz.show', compact('invoice'));
    }
    public function download(string $id)
    {
        $invoice = Invoice::findorfail($id);
        $pdf = Pdf::loadView('invoices.invoice', compact('invoice'))->setPaper('a4', 'landscape');
        return $pdf->stream(time() . '.pdf');
        // return view('invoices.invoice',compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = Invoice::findorfail($id);
        $clients = Client::orderBy('name')->get();

        return view('invoices.edit', compact('invoice', 'clients'));
    }
    public function edit_tz(string $id)
    {
        $invoice = Invoice::findorfail($id);
        $trainings = Course::all();
        $licences = Licence::all();

        return view('invoices-tz.edit', compact('invoice', 'licences', 'trainings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'valid_date' => 'required',
            'expired_date' => 'required',
            'client_id' => 'required',
        ]);

        if (!$request->has('training') && !$request->has('licence')) {
            return back()->with('warning1', 'You must select Atleast one training or one License');
        }

        if ($request->has('training')) {

            $request->merge([
                'training' => implode('_', $request->training),
                'training_qty' => implode('_', $request->training_qty),
                'training_discount' => implode('_', $request->training_discount),
            ]);

        }
        if ($request->has('licence')) {

            $request->merge([
                'licence' => implode('_', $request->licence),
                'licence_qty' => implode('_', $request->licence_qty),
                'licence_discount' => implode('_', $request->licence_discount),
            ]);

        }

        if ($request->notes != null) {
            $request->merge(['notes' => $request->notes]);
        } else {
            $request->merge(['notes' => Invoice::find($id)->notes]);
        }

        try {
            Invoice::find($id)->update($request->all());
            return back()->with('message', 'Invoice updated successfully');

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
        Invoice::find($id)->delete();
        return back()->with('message', 'Invoice Deleted successfully');
    }
    public function send_invoice(Request $request, string $id)
    {
        $invoice = Invoice::find($id);
        $pdf = Pdf::loadView('invoices.invoice', compact('invoice'))->setPaper('a4', 'landscape');
        $pdfContent = $pdf->output();

        try {
            Mail::to($request->to)->send(new InvoiceEmail($pdfContent, $request->subject, $request->message, $request->from));
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        // dd($request->all(), $invoice);

        return back()->with('message', 'Invoice Sent successfully');
    }
}
