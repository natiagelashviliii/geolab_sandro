<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Index() {

    	$Contact = Contact::where('id', 1)->first();
    	$Data = [
    		'Socials' => json_decode($Contact['socials'], true)
    	];

    	return view('main/index', $Data);
    }
}
