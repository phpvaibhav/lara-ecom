<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
class AdminController extends Controller
{
    public function __construct()
    {
       
    }
    public function dashboard(){
   		$data['front_scripts'] = array('js/pages/dashboard.js');
    	return View::make('backend_pages.dashboard',$data);
    }//end function
}
