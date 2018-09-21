<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WorksController extends Controller
{
    public function index() {

    	$Contact = Contact::where('id', 1)->first();
    	$Data = [
    		'Mode'    => Session::has('mode') ? Session::get('mode') : false ,
    		'Socials' => json_decode($Contact['socials'], true)
    	];

    	return view('works/index', $Data);

    }
}
