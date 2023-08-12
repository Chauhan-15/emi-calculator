@extends('calculator.layout')

@section('content')
    <div class="flex flex-col items-center justify-center my-6 sm:my-24">
        <div class="w-2/5 p-10 border-2 border-gray-200 rounded-md shadow-md ">
            <h1 class="text-3xl font-bold text-center text-gray-700">EMI Calculator</h1>
            <div class="mt-4">
                <form method="post" action="{{ route('calculations.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="grid" for="purchasePrice">
                            <h1 class="mb-1 font-semibold text-gray-700">Purchase Price</h1>
                            <input type="text" class="p-2 border border-gray-300 rounded-sm focus:outline-none" value="{{ old('purchase_price') }}" name="purchase_price" id="purchase_price" placeholder="Purchase Price">
                        </label>
                        @error('purchase_price')
                            <div class="text-sm font-semibold text-red-500">{{ $message }}</div>
                        @enderror                
                    </div>
                    <div class="mb-4">
                        <label class="grid" for="downPayment">
                            <h1 class="mb-1 font-semibold text-gray-700">Down Payment</h1>
                            <input type="text" class="p-2 border border-gray-300 rounded-sm focus:outline-none" value="{{ old('down_payment') }}" name="down_payment" placeholder="Down Payment">
                        </label>
                        @error('down_payment')
                            <div class="text-sm font-semibold text-red-500">{{ $message }}</div>
                        @enderror                
                    </div>
                    <div class="mb-4">
                        <label class="grid" for="repaymentTime">
                            <h1 class="mb-1 font-semibold text-gray-700">Repayment Time</h1>
                            <select name="repayment_time" class="p-2 border border-gray-300 rounded-sm focus:outline-none" id="repaymentTime">
                                <option value=null disabled selected hidden>Repayment Time</option>
                                @foreach ($tenures as $key => $tenure)
                                    <option value="{{ $key }}" {{ old('repayment_time') == $key ? 'selected' : '' }}>{{ $tenure}}</option>
                                @endforeach
                            </select>
                        </label>
                        @error('repayment_time')
                            <div class="text-sm font-semibold text-red-500">{{ $message }}</div>
                        @enderror                
                    </div>
                    <div class="mb-4">
                        <label class="grid" for="interestRate">
                            <h1 class="mb-1 font-semibold text-gray-700">Interest Rate (%)</h1>
                            <input type="text" value="{{ old('interest_rate') }}" class="p-2 border border-gray-300 rounded-sm focus:outline-none" name="interest_rate" placeholder="Interest Rate">
                        </label>
                        @error('interest_rate')
                            <div class="text-sm font-semibold text-red-500">{{ $message }}</div>
                        @enderror                
                    </div>
                    <button type="submit" class="px-4 py-2 text-green-500 bg-green-100 border border-green-500 rounded-md">Calculate</button>
                </form>
                <div class="mt-6">
                    <div>
                        Loan Amount: {{ $loanAmount ?? 0 }}
                    </div>
                    <div>
                        Monthly Payment: {{ $monthlyPayment ?? 0 }}
                    </div>     
                    <div>
                        Total Payment: {{ $totalPayment ?? 0 }}
                    </div>                
                </div>
            </div>
        </div>
    </div>
@endsection