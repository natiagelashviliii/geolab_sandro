<?php

namespace App\Http\Controllers;

use App\Models\Works;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class WorksController extends Controller
{
    public function index($slugFilter = '') {

    	print_r($slugFilter);

    	if (!$slugFilter) {
    		$Works = Works::select('works.*')
                        ->where('works.status', '=', 1)
                        ->where('categories.title', $slugFilter)
                        ->join('categories','works.cat_id','=','categories.id')
                        ->orderBy('works.id', 'desc');
    	} else {
    		$Works = Works::select('works.*')
                        ->where('works.status', '=', 1)
                        ->orderBy('works.id', 'desc');
    	}

    	print_r($Works);

    	$Contact = Contact::where('id', 1)->first();
    	$Categories = DB::table('categories')->where('status', '1')->get();
    	$Data = [
    		'Mode'    	 => Session::has('mode') ? Session::get('mode') : false ,
    		'Socials' 	 => json_decode($Contact['socials'], true),
    		'Categories' => $Categories,
    		'Works'		 => $Works
    	];

    	return view('works/index', $Data);

    }
}
