<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
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
    	$Categories = DB::table('categories')->where('status', '1')->get();
        return view('admin/categories/index', ['Cats' => $Categories]);
    }
    public function Add()
    {
        return view('admin/categories/add');
    }

    public function AddCategory(Request $request){
    	$this->validate($request, [
    		'Title' => 'required',
    	]);

    	DB::table('categories')->insert(
		    ['title' => $request->input('Title')]
		);

		return redirect()->route('admin.categories.index');
    }

    public function Edit($id = null) {
    	if (is_null($id) || !is_numeric($id)) {
    		return redirect()->route('admin.categories.index');
    	}

    	$data = DB::table('categories')->where('id', $id)->first();

    	return view('admin/categories/edit', ['Data' => $data]);
    }

    public function EditCategory(Request $request){
    	$this->validate($request, [
    		'Title' => 'required',
    		'CatID' => 'required'
    	]);

    	DB::table('categories')->where('id', $request->input('CatID'))->update(['title' => $request->input('Title')]);
    	return redirect()->route('admin.categories.index');
    }

    public function Delete(Request $request) {
    	$query = DB::table('categories')->where('id', $request->input('CatID'))->update(['status' => 0]);

    	return ['success' => $query];
    }
}
