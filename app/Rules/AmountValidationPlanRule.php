<?php

namespace App\Rules;

use App\Models\Plan;
use Illuminate\Contracts\Validation\Rule;

class AmountValidationPlanRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $plan = Plan::where('id', $value)->first();

        if($plan->id == 6){
            return $plan->minimum_fee <= $this->amount;
        }

        return $plan->minimum_fee <= $this->amount && ($plan->maximum_fee >= $this->amount);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The amount is not between range.';
    }
}
