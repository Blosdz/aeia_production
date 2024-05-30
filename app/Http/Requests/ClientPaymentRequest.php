<?php

namespace App\Http\Requests;

use App\Rules\AmountValidationPlanRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PlanRule;

class ClientPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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
        $amount = $this->amount;
        return [
            'plan_id' => ['required', new PlanRule, new AmountValidationPlanRule($amount)],
            'code'    => ['alpha_num', 'nullable'],
            'amount'  => ['numeric'],
        ];
    }
}
