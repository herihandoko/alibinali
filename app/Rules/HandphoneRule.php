<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class HandphoneRule implements Rule {

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
            if (substr($value, 0, 2) == '62')
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
        return 'No telepon harus ber awalan 62.';
    }
}
