<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->Response = ['StatusCode' => 0];
		$this->Path = url('/') .'/storage/tmp/';
	}

    public function UploadPhoto(Request $request)
    {
    	$this->Response['StatusCode'] = 1;

    	if ($request->input('PostGroup') == 'about') {
            $fileExt         = $request->file('Image')->GetClientOriginalExtension();
            $fileNameToStore = time() . '.' . $fileExt;
            $path            = $request->file('Image')->storeAs('public/tmp', $fileNameToStore);
    	} else if ($request->input('PostGroup') == 'works') {
            $fileExt         = $request->file('File')->GetClientOriginalExtension();
            $fileNameToStore = time() . '.' . $fileExt;
            $path            = $request->file('File')->storeAs('public/tmp', $fileNameToStore);
        }

    	$this->Response['Data']['FilesList'][] = $this->Path . $fileNameToStore;

    	return $this->Response;
    }

}
