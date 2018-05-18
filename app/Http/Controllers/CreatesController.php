<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class CreatesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
    	$companies = Company::all();
    	return view('index', ['companies' => $companies]);
    }

    public function add(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required',
    		'email' => 'required',
            'logo' => 'image|nullable|max:1999'
    	]);

        if ($request->hasFile('logo')) {
            
            $filenameWithExt = $request->file('logo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('logo')->storeAs('public/logos', $filenameToStore);

        } else {
            $filenameToStore = 'noimage.jpg';
        }
        

    	$companies = new Company;
    	$companies->name = $request->input('name');
    	$companies->email = $request->input('email');
    	$companies->logo = $filenameToStore;
    	$companies->website = $request->input('website');
    	$companies->save();

    	return redirect('/index')->with('info', 'Successfully Added New Company!');
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

        if ($request->hasFile('logo')) {
            
            $filenameWithExt = $request->file('logo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('logo')->storeAs('public/logos', $filenameToStore);

        } else {
            $filenameToStore = 'noimage.jpg';
        }

    	$data = array(
    		'name' => $request->input('name'),
    		'email' => $request->input('email'),
    		'logo' => $filenameToStore,
    		'website' => $request->input('website') 
    	);

    	Company::where('id', $id)->update($data);

    	return redirect('/index')->with('info', 'Successfully Updated Company!');
    }
}
