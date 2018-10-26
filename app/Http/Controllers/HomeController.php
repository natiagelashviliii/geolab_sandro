<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function Index() {
        
    	$Contact = Contact::where('id', 1)->first();
    	$Data = [
    		'Mode' => Session::has('mode') ? Session::get('mode') : false ,
    		'Socials' => json_decode($Contact['socials'], true),
            'Random' => rand(0,2)
    	];

    	return view('main/index', $Data);
    }

    public function ChangeMode(Request $request) {

    	Session::put('mode', $request->input('mode'));

    	return json_encode(['message' => Session::get('mode')]);
    
    }

}
