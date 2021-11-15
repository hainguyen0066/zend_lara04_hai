<?php

namespace App\Http\Requests;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    private $table            = 'user';
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
        $id = $this->id;
        $task   = $this->task;
        $condAvatar   = '';
        $condUserName = '';
        $condEmail    = '';
        $condPass     = '';
        $condLevel    = '';
        $condStatus   = '';
        $condFullname = '';
        $condCurrent  = '';


        switch ($task) {
            case 'add':
                $condUserName   = "bail|required|between:5,100|unique:$this->table,username";
                $condEmail      = "bail|required|email|unique:$this->table,email";
                $condFullname   = 'bail|required|min: 5';
                $condPass       = 'bail|required|between:5,100|confirmed';
                $condStatus     = 'bail|in:active,inactive';
                $condLevel      = 'bail|in:admin,member';
                $condAvatar     = 'bail|required|image|max:500';
                break;
            case 'edit-info':
                $condUserName   = "bail|required|between:5,100|unique:$this->table,username,$id";
                $condFullname   = 'bail|required|min: 5';
                $condAvatar     = 'bail|image|max:500';
                $condStatus     = 'bail|in:active,inactive';
                $condEmail      = "bail|required|email|unique:$this->table,email,$id";
                break;
            case 'change-password':
                $condPass = 'bail|required|between:5,100|confirmed';
                $condCurrent =['required', 'between:5,100|',new MatchOldPassword()];
                break;
            case 'change-level':
                $condLevel = 'bail|in:admin,member';
                break;
            case 'change-password-of-user':
                $condCurrent =['required|between:5,100', new MatchOldPassword()];
                $condLevel   = 'bail|required|between:5,100|confirmed';
                break;
            default:
                break;
        }


        return [
            'username' => $condUserName,
            'email'    => $condEmail,
            'fullname' => $condFullname,
            'status'   => $condStatus,
            'password' => $condPass,
            'level'    => $condLevel,
            'avatar'   => $condAvatar,
            'password_current'   => $condCurrent
        ];
    }

    public function messages()
    {
        return [
            // 'name.required' => 'Name không được rỗng',
            // 'name.min'      => 'Name :input chiều dài phải có ít nhất :min ký tứ',
        ];
    }
    public function attributes()
    {
        return [
            // 'description' => 'Field Description: ',
        ];
    }
}
