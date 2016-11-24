<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\LoginValidator;

use App\Account;

use Illuminate\Support\Facades\Input as Input;
use Redirect;
use Validator;
use Session;
use View;

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

		Session::put('username', $account->Username);
 		Session::put('active', true);
		Session::put('firstname', $account->Firstname);
		Session::put('lastname', $account->Lastname);

		$controller = '';
		switch ($account->PositionID) {
			case 1:
				$controller = 'BusinessControllers\AdminPageController@viewDashboard';
				break;
			case 2:
				$controller = 'Dashboard@index';
				break;
			case 3:
				$controller = 'BusinessControllers\InventoryPageController@viewDashboard';
				break;

			case 4:
				$controller = 'BusinessControllers\ProcurementPageController@viewDashboard';
				break;
		}

		Session::put('controller', $controller);
		return Redirect::action($controller);
	}

	public function logout(Request $request){
		 Session::flush();

		 return Redirect::action('PageController@index');
	}
}
