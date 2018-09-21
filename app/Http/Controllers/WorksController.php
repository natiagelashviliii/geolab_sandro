<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class WorksController extends Controller
{
    public function index() {

    	$Contact = Contact::where('id', 1)->first();
    	$Data = [
    		'Socials' => json_decode($Contact['socials'], true)
    	];

    	return view('works/index', $Data);

    }
}
