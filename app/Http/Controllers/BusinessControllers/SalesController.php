<?php

namespace App\Http\Controllers\BusinessControllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    public function viewDashboard(){
    	return view('SalesPages\dashboard');
    }
}
