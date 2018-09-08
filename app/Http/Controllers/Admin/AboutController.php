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

        $HasPhoto = 0;
        $fileNameToStore = '';
        if ($request->input('Photos')) {
            $Photo = $request->input('Photos');
            if (Storage::disk('public')->exists('tmp/', $Photo)) {
                $HasPhoto ++;
                $PhotoExt = explode('.', $Photo);
                $Ext = $PhotoExt[count($PhotoExt) - 1];
                if (Storage::exists('public/about/about_1.' . $Ext)) {
                    Storage::delete('public/about/about_1.' . $Ext);
                }
                Storage::move('public/tmp/' . $Photo, 'public/about/about_1.' . $Ext);
                $fileNameToStore = 'about_1.' . $Ext;
            }
        }

        About::updateOrCreate(
            ['id' => 1],
            [
                'title' => $request->input('Title'), 
                'description' => $request->input('Description'),
                'image' => $fileNameToStore,
            ]
        );

        if (!is_null($HasPhoto)) {
            About::increment('photo_ver');    
        }

    	return redirect()->route('admin.about.index');
    }

}
