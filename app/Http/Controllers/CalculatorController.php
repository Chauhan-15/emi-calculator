<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculationRequest;

class CalculatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenures = config('tenure.repayment_tenure');
        return view('calculator.index', compact('tenures'));
    }

    /**
     * calculate EMI.
     * 
     * @param  \Illuminate\Http\CalculationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CalculationRequest $request)
    {
        $validatedRequest = $request->validated();
        $purchasePrice    = $validatedRequest['purchase_price'];
        $downPayment      = $validatedRequest['down_payment'];
        $repaymentTime    = $validatedRequest['repayment_time'];
        $interestRate     = $validatedRequest['interest_rate'];

        $loanAmount  = $purchasePrice - $downPayment;
        $monthlyInterestRate = ($interestRate / 12) / 100;
        $totalPayment = $purchasePrice + ($monthlyInterestRate * 12);

        // calculate emi
        $monthlyPayment = ($loanAmount * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$repaymentTime));
        $request->flash();

        return view('calculator.index', [
            'loanAmount'     => $loanAmount,
            'monthlyPayment' => round($monthlyPayment, 2),
            'tenures'        => config('tenure.repayment_tenure'),
            'totalPayment'   => round($totalPayment, 2)
        ]);
    }
}
