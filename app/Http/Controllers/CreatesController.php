<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class CreatesController extends Controller
{
    public function index(){
    	$companies = Company::all();
    	return view('index', ['companies' => $companies]);
    }
}
