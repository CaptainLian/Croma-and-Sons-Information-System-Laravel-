<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Session;
use Redirect;

class PageController extends Controller{

    public function index(){
    	if(Session::has('active')){
    		return Redirect::action(Session::get('controller').'@viewDashboard');
    	}

    	return view('Login');
    }
}
