<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

abstract class MasterPageController extends Controller{

	abstract public function dashboard();
}
