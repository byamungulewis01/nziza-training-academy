<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Invoice;
use App\Models\Licence;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $invoices = Invoice::orderByDesc('id')->get();

        return view('invoices.index', compact('invoices'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $trainings = Course::all();
        $licences = Licence::all();
        return view('invoices.create', compact('trainings', 'licences'));

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
            'address' => 'required',
            'salesperson' => 'required',
        ]);

        if ($request->has('training')) {
            $trainings = implode('_', $request->training);
            $training_qty = implode('_', $request->training_qty);
            $training_discount = implode('_', $request->training_discount);

            $trainingLength = count($request->training);
            $training_qtyLength = count($request->training_qty);
            if ($trainingLength != $training_qtyLength) {
                return back()->with('warning1', 'Please fill all trainings');
            }
            $totalTrainingPrice = 0;
            $totalTrainingDiscountPrice = 0;
            for ($i = 0; $i < $trainingLength; $i++) {

                $training_price = Course::find($request->training[$i])->price;
                $totalTrainingPrice += $training_price;
                $to_with_discount = ($training_price * $request->training_qty[$i]) * ($request->training_discount[$i] / 100);
                $totalTrainingDiscountPrice += $to_with_discount;
            }


        } else {
            $trainings = null;
            $training_qty = null;
            $training_discount = null;
        }
        if ($request->has('licence')) {
            $licence = implode('_', $request->licence);
            $licence_qty = implode('_', $request->licence_qty);
            $licence_discount = implode('_', $request->licence_discount);

            $licenceLength = count($request->licence);
            $licence_qtyLength = count($request->licence_qty);
            if ($licenceLength != $licence_qtyLength) {
                return back()->with('warning1', 'Please fill all Licence');
            }
            $totalLicencePrice = 0;
            $totalLicenceDiscountPrice = 0;
            for ($i = 0; $i < $licenceLength; $i++) {

                $licence_price = Licence::find($request->licence[$i])->price;
                $totalLicencePrice += $licence_price;
                $total_with_discount = ($licence_price * $request->licence_qty[$i]) * ($request->licence_discount[$i] / 100);
                $totalLicenceDiscountPrice += $total_with_discount;
            }
        } else {
            $licence = null;
            $licence_qty = null;
            $licence_discount = null;
        }
        $totalTraining = @$totalTrainingPrice - @$totalTrainingDiscountPrice;
        $totalLicence = @$totalLicencePrice - @$totalLicenceDiscountPrice;

        $request->merge([
            'invoice_no' => now()->year . 'NGT' . str_pad(Invoice::count() + 1, 3, '0', STR_PAD_LEFT),
            'training' => $trainings,
            'training_qty' => $training_qty,
            'training_discount' => $training_discount,
            'licence' => $licence,
            'total' => $totalTraining + $totalLicence,
            'licence_qty' => $licence_qty,
            'licence_discount' => $licence_discount,
        ]);

        if ($request->has('training') || $request->has('licence')) {

            try {
                Invoice::create($request->all());
                return back()->with('message', 'Invoice created successfully');

            } catch (\Throwable $th) {
                //throw $th;
                return back()->with('error', $th->getMessage());

            }

        } else {
            return back()->with('warning1', 'You must select Atleast one training or one Licence');
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = Invoice::findorfail($id);
        $trainings = Course::all();
        $licences = Licence::all();

        return view('invoices.edit', compact('invoice', 'licences', 'trainings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'valid_date' => 'required',
            'expired_date' => 'required',
            'address' => 'required',
            'salesperson' => 'required',
        ]);

        if ($request->has('training')) {
            $trainings = implode('_', $request->training);
            $training_qty = implode('_', $request->training_qty);
            $training_discount = implode('_', $request->training_discount);

            $trainingLength = count($request->training);
            $training_qtyLength = count($request->training_qty);
            if ($trainingLength != $training_qtyLength) {
                return back()->with('warning1', 'Please fill all trainings');
            }
            $totalTrainingPrice = 0;
            $totalTrainingDiscountPrice = 0;
            for ($i = 0; $i < $trainingLength; $i++) {

                $training_price = Course::find($request->training[$i])->price;
                $totalTrainingPrice += $training_price;
                $to_with_discount = ($training_price * $request->training_qty[$i]) * ($request->training_discount[$i] / 100);
                $totalTrainingDiscountPrice += $to_with_discount;
            }


        } else {
            $trainings = null;
            $training_qty = null;
            $training_discount = null;
        }
        if ($request->has('licence')) {
            $licence = implode('_', $request->licence);
            $licence_qty = implode('_', $request->licence_qty);
            $licence_discount = implode('_', $request->licence_discount);

            $licenceLength = count($request->licence);
            $licence_qtyLength = count($request->licence_qty);
            if ($licenceLength != $licence_qtyLength) {
                return back()->with('warning1', 'Please fill all Licence');
            }
            $totalLicencePrice = 0;
            $totalLicenceDiscountPrice = 0;
            for ($i = 0; $i < $licenceLength; $i++) {

                $licence_price = Licence::find($request->licence[$i])->price;
                $totalLicencePrice += $licence_price;
                $total_with_discount = ($licence_price * $request->licence_qty[$i]) * ($request->licence_discount[$i] / 100);
                $totalLicenceDiscountPrice += $total_with_discount;
            }
        } else {
            $licence = null;
            $licence_qty = null;
            $licence_discount = null;
        }
        $totalTraining = @$totalTrainingPrice - @$totalTrainingDiscountPrice;
        $totalLicence = @$totalLicencePrice - @$totalLicenceDiscountPrice;

        $request->merge([
            'training' => $trainings,
            'training_qty' => $training_qty,
            'training_discount' => $training_discount,
            'licence' => $licence,
            'total' => $totalTraining + $totalLicence,
            'licence_qty' => $licence_qty,
            'licence_discount' => $licence_discount,
        ]);

        if ($request->notes != null) {
            $request->merge(['notes' => $request->notes]);
        } else {
            $request->merge(['notes' => Invoice::find($id)->notes]);
        }

        if ($request->has('training') || $request->has('licence')) {

            try {
                Invoice::find($id)->update($request->all());
                return back()->with('message', 'Invoice Updated successfully');

            } catch (\Throwable $th) {
                //throw $th;
                return back()->with('error', $th->getMessage());
            }

        } else {
            return back()->with('warning1', 'You must select Atleast one training or one Licence');
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
}
