<?php
namespace App\Plugins\TuitionPayment\Controllers;

use App\Http\Controllers\Controller;
use App\Plugins\TuitionPayment\Models\TuitionPayment;
use Illuminate\Http\Request;

class TuitionPaymentController extends Controller
{
    public function index()
    {
        $payments = TuitionPayment::all();
        return view('TuitionPayment::index', compact('payments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
        ]);

        TuitionPayment::create($request->all());
        return redirect()->back()->with('success', 'Payment recorded.');
    }
}
