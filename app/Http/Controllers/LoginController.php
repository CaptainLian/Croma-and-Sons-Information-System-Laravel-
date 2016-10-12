<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\LoginValidator;

use Validator;
use Input;
class LoginController extends Controller{

	public function validateLogin(LoginValidator $validator){
		
		if($validator->fails()){
			return Redirect::back()->withErrors($validator)
								   ->withInput(Input::Except(['password']));
		}

		$enteredUsername = Input::get('username');
		$enteredPassword = Input::get('password');

		if($validator->matchPassword($enteredUsername, $enteredPassword)){
			return redirect('aguy');
		}

	}
}
