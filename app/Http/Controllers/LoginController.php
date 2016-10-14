<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\LoginValidator;

use App\Account;

use Redirect;
use Validator;
use Input;

class LoginController extends Controller{


	const LOGIN_RULES = ['username' => 'bail|required|exists:Accounts,Username',
               			  'password' => 'bail|required'];
    const LOGIN_ERROR_MESSAGES = ['required' => 'Please input your :attribute.',
              					   'username.exists' => 'Username is not associated to any account.'];

	public function validateLogin(Request $request){
		
		$validator = Validator::make(Input::all(), LoginController::LOGIN_RULES, LoginController::LOGIN_ERROR_MESSAGES);

		if($validator->fails()){
			return Redirect::back()
						   ->withErrors($validator)
						   ->withInput(Input::except('password'));
		}


		$inputPassword = Account::dbEncrypt(Input::get('password'));
		$account = Account::getAccountWithUsername(Input::get('username'));

		if($inputPassword !== $account->Password){
			 return Redirect::back()
						   ->withErrors(['password' => 'Incorrect password or username.'])
						   ->withInput(Input::except('password'));
		}

		return 'Hello: '.$account->Username;
	}

	public function logout(Request $request){
		 
	}
}
