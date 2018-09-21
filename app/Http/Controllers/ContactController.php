<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function Index() {

    	$Contact = Contact::where('id', 1)->first();

    	$Data = [
    		'Contact' => $Contact,
    		'Mode'    => Session::has('mode') ? Session::get('mode') : false ,
    		'Socials' => json_decode($Contact['socials'], true)
    	];

    	return view('contact/index', $Data);
    	
    }
}
