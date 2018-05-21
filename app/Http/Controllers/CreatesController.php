<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\database;
use App\Company;
use App\Asset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class CreatesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){

      $companies = Company::from('companies')
            ->join('assets', 'companies.id', '=', 'assets.company_id')
            ->select('companies.name', 'companies.email', 'companies.logo', 'companies.website', 'assets.name', 'assets.description', 'assets.model', 'assets.value')
            ->get();
dd($companies);
    	//return view('index', ['companies' => $companies]);
    }

    public function add(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required',
    		'email' => 'required',
            'logo' => 'image|nullable|max:1999|dimensions:min_width=100,min_height=100',
            'asset' => 'nullable'
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
        $id = $companies->save();

        $assets = new Asset;

        foreach ($request->asset as $key => $value) {
            $assets->name = $value;
            $assets->company_id = $id;
            $assets->description = $request->description[$key];
            $assets->model = $request->model[$key];
            $assets->value = $request->value[$key];
            $assets->save();
        }

        Mail::send('emails.contact', [], function ($m) use($request){
            $m
              ->from($request->get('email'))
              ->to('sanjiarya2112@gmail.com')
              ->subject('Your Reminder!');
        });


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
