<?php

namespace App\Http\Controllers\BusinessControllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InventoryPageController extends Controller
{
    public function viewDashboard(){
    	return 'Inventory';
    }
}
