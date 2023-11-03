<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class VirtualAccountRule implements Rule {

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $request;

    public function __construct($request) {
        //
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value = '') {
        if ($value) {
            if (substr($value, 0, 5) == env('BTN_API_PARTNER_SERVICE_ID'))
                return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        return 'Virtual Account Tidak Benar.';
    }
}
