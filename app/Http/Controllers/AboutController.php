<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Contact;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function Index() {

    	$About = About::where('id', 1)->first();
    	$Contact = Contact::where('id', 1)->first();

    	$Data = [
    		'About'   => $About,
    		'Socials' => json_decode($Contact['socials'], true)
    	];

    	return view('about/index', $Data);
    }
}
