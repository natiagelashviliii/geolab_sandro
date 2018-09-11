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

        //update file
        
        $HasPhoto = 0;
        if ($request->hasFile('File')) {
            $HasPhoto ++;
            $fileNameWithExt = $request->file('File')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $Ext = $request->file('File')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $Ext;
            $path = $request->file('File')->storeAs('public/about', $fileNameToStore);

            About::where('id', 1)->update(['image' => $fileNameToStore]);
        }

        if (!is_null($HasPhoto)) {
            About::increment('photo_ver');    
        }

    	return redirect()->route('admin.about.index');
    }

}
