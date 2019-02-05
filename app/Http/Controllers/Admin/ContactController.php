<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	public function Index()
    {
        $Contact = Contact::where('id', 1)->first();
        return view('admin/contact/index', ['Data' => $Contact, 'Socials' => json_decode($Contact['socials'], true)]);
    }

    public function EditContact(Request $request)
    {
    	$this->validate($request, [
    		'Email'   => 'required',
    		'Phone'   => 'required',
            'Socials' => 'required'
    	]);

    	$Contact = Contact::updateOrCreate(
            ['id' => 1],
            [
                'email' => $request->input('Email'), 
                'phone' => $request->input('Phone'),
                'socials' => json_encode($request->input('Socials'))
            ]
        );

    	return redirect()->route('admin.contact.index');
    }

}
