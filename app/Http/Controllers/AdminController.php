<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
class AdminController extends Controller
{
    public function __construct(){

    }
    public function dashboard(){
   
    	return View::make('backend_pages.blank');
    }//end function
}
