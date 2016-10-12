<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use app\Account;

class LoginValidator extends FormRequest{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['username' => 'bail|required|exists:Accounts, Username',
                'password' => 'bail|required'];
    }

    public function messages(){
        return ['required' => 'Please input your :attribute',
                'username.exists' => 'Username is not associated to any account.'];

    }

    public function matchPassword($username, $pass){
        $password = Account::getAccountPassword($username);
        return $password === Account::dbEncrypt($pass);
    }


    public function fails(){
        parent::fails();
    }
}
