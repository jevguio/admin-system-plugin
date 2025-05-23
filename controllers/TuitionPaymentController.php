<?php

namespace plugins\adminsystem\controllers;

use App\Http\Controllers\Controller;
use plugins\adminsystem\models\TuitionPayment;
use Illuminate\Http\Request;

class TuitionPaymentController extends Controller
{
    public function index(Request $request)
    {
        $subscriptions = auth()->user()->subscriptions()->where('stripe_status', 'active')->get();

        $activationCodes = $subscriptions->pluck('activation_code')->toArray();

        $plugin = collect(\App\PluginHook::getPlugin())->firstWhere('gitUrl', $request->gitUrl);

        if ($plugin && in_array($plugin['activation_code'], $activationCodes)) {
            // Allow access


            $payments = TuitionPayment::all();
            return view('TuitionPayment::index', compact('payments'));
        } else {
            // Deny access
 
            return back()->with('error', 'Failed to install plugin: ');

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
