<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function Index() {

    	$Contact = Contact::where('id', 1)->first();

    	$Data = [
    		'Contact' => $Contact,
    		'Socials' => json_decode($Contact['socials'], true)
    	];

    	return view('contact/index', $Data);
    	
    }
}
