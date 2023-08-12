<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CalculationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'purchase_price' => 'required|numeric|gt:down_payment',
            'down_payment'   => 'required|numeric',
            'repayment_time' => ['required', 'numeric', Rule::in(array_keys(config(key: 'tenure.repayment_tenure')))],
            'interest_rate'  => 'required|numeric',
        ];
    }
}
