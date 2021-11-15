<?php

namespace App\Rules;

use App\Models\UserModel;
use Illuminate\Contracts\Validation\Rule;
use MongoDB\Driver\Session;

class MatchOldPassword implements Rule
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
       if (Session('userInfo')) {
           $user = UserModel::find(session()->get('userInfo')['id']);

           return  md5($value) == $user->password ?? false;
       }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Password cũ không đúng';
    }
}
