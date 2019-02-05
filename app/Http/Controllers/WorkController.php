<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Contact;
use App\Models\Works;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WorkController extends Controller
{
    public function Index($name, $id) {

    	$Contact = Contact::where('id', 1)->first();

    	$Work = Works::where('id', $id)->first();
        
        if ($Work->video) {
            $Work->video_embed = Helper::GenerateVideoEmbed($Work->video);
        }

        $Tags = Works::find($id)->tags()->pluck('name')->toArray();

    	$Data = [
    		'Contact' => $Contact,
    		'Mode'    => Session::has('mode') ? Session::get('mode') : false ,
    		'Socials' => json_decode($Contact['socials'], true),
    		'Work'    => $Work,
    		'Tags'    => $Tags
    	];

    	return view('works/details', $Data);
    	
    }
}
