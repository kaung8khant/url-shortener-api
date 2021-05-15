<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Blacklist implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        //
        $lists = config('blacklist');
        foreach ($lists as $list) {
            $result = preg_match('/\b' . $list . '\b/', $value);
            if ($result == 1) {
                return false;
            }
        }
        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This url is blacklisted!';
    }
}
