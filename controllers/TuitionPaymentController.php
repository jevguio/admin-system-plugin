<?php

namespace plugins\adminsystem\controllers;

use App\Http\Controllers\Controller;
use plugins\adminsystem\models\TuitionPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class TuitionPaymentController extends Controller
{
    public function index(Request $request)
    {
        // Check if table exists
        if (!Schema::hasTable('tuition_payments')) {
            Artisan::call('migrate', [
                '--path' => 'plugins/adminsystem/migrations',
                '--force' => true,
            ]);
        }

        $subscriptions = auth()
            ->user()
            ->subscriptions()
            ->where('type', '=', 'adminsystem')
            ->where('stripe_status', '!=', 'canceled')
            ->first();

        if ($subscriptions) {
            $payments = TuitionPayment::all();
            return view('view::TuitionPayment.index', compact('payments'));
        } else {
            return back()->with('error', 'Subscription Expired');
        }
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
