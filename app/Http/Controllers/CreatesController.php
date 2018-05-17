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

    public function update($id)
    {
    	$companies = Company::find($id);
    	return view('company', ['companies' => $companies]);
    }

    public function edit(Request $request, $id)
    {
    	$this->validate($request, [
    		'name' => 'required',
    		'email' => 'required'
    	]);

    	$data = array(
    		'name' => $request->input('name'),
    		'email' => $request->input('email'),
    		/*'logo' => $request->input('logo'),*/
    		'website' => $request->input('website') 
    	);

    	Company::where('id', $id)->update($data);

    	return redirect('/')->with('info', 'Successfully Updated Company!');
    }
}
