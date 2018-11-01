<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\File;
use \Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	public function Index()
    {
        $About = About::where('id', 1)->first();
        return view('admin/about/index', ['Data' => $About]);
    }

    public function EditAbout(Request $request)
    {
    	$this->validate($request, [
    		'Title' 	  => 'required',
    		'Description' => 'required',
    	]);

        About::updateOrCreate(
            ['id' => 1],
            [
                'title' => $request->input('Title'), 
                'description' => $request->input('Description'),
            ]
        );

    	return redirect()->route('admin.about.index');
    }

}
