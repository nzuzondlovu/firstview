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

    public function add(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required',
    		'email' => 'required'
    	]);

    	$companies = new Company;
    	$companies->name = $request->input('name');
    	$companies->email = $request->input('email');
    	/*$companies->logo = $request->input('logo');*/
    	$companies->website = $request->input('website');
    	$companies->save();

    	return redirect('/')->with('info', 'Successfully Added New Company!');
    }
}
