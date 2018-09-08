<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Tags;
use App\Models\Works;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Storage;

class WorksController extends Controller
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
	public function Index(Request $request)
    {
        if ($request->has('cat')) {
            $Works = Works::select('works.*', 'categories.title AS cat_title')
                        ->where('works.status', '!=', 2)
                        ->where('categories.id', $request->query('cat'))
                        ->join('categories','works.cat_id','=','categories.id')
                        ->orderBy('works.id', 'desc')
                        ->paginate(12)
                        ->appends('cat', $request->query('cat'));    
        } else {
            $Works = Works::select('works.*', 'categories.title AS cat_title')
                        ->where('works.status', '!=', 2)
                        ->join('categories','works.cat_id','=','categories.id')
                        ->orderBy('works.id', 'desc')
                        ->paginate(12);
        }

        $Categories = DB::table('categories')->where('status', '1')->get();

        return view('admin/works/index', ['Works' => $Works, 'Cats' => $Categories]);
    }

    public function Add() {
        $data = array();
        $cats = Categories::where('status', 1)->get();

        $data = [
            'tags' => json_encode($this->GetTags()),
            'cats' => $cats
        ];

    	return view('admin/works/add', ['data' => $data]);
    }

    public function Edit($id = null) {
        if (is_null($id) || !is_numeric($id)) {
            return view('admin/works/index');
        }

    	$data = array();
        $cats = Categories::where('status', 1)->get();
        $work = Works::select('works.*', 'categories.title AS cat_title')
                        ->where('works.id', $id)
                        ->join('categories','works.cat_id','=','categories.id')
                        ->orderBy('works.id', 'desc')
                        ->first();

        $data = [
            'tags' => json_encode($this->GetTags()),
            'cats' => $cats,
            'work' => $work,
            'usedTags' => json_encode($this->GenerateUsedTags($id))
        ];

    	return view('admin/works/edit', ['data' => $data]);
    }

    public function AddWork(Request $request) {
        $this->validate($request, [
            'Title'       => 'required',
            'Description' => 'required',
            'CatID'       => 'required'
        ]);

        $workID = DB::table('works')->insertGetId(
            [
                'title'       => $request->input('Title'),
                'description' => $request->input('Description'),
                'cat_id'      => $request->input('CatID'),
                'file'        => '',
                'file_ver'    => 0
            ]
        );

        $Tags = explode(',', $request->input('Tags'));

        if (!empty($Tags)) {
            foreach ($Tags as $key => $value) {
                Tags::firstOrCreate(['name' => $value]);
                $tag = Tags::where('name', $value)->first();

                DB::table('work_tags')->insert(
                    ['work_id' => $workID, 'tag_id' => $tag->id]
                );
            }
        }

        $HasFile = 0;
        $fileNameToStore = 'noImage.jpg';
        if ($request->input('Photos')) {
            $File = $request->input('Photos');
            if (Storage::disk('public')->exists('tmp/', $File)) {
                $HasFile ++;
                $PhotoExt = explode('.', $File);
                $Ext = $PhotoExt[count($PhotoExt) - 1];
                if (Storage::exists('public/works/' . $workID . '.' . $Ext)) {
                    Storage::delete('public/works/' . $workID . '.' . $Ext);
                }
                Storage::move('public/tmp/' . $File, 'public/works/' . $workID . '.' . $Ext);
                $fileNameToStore = $workID . '.' . $Ext;
            }
        }

        DB::table('works')->where('id', $workID)->update(['file' => $fileNameToStore]);

        if (!is_null($HasFile)) {
            Works::where('id', $workID)->increment('file_ver');
        }

        return redirect()->route('admin.works.index');
    }

    //help functions

    public function GetTags() {
        $tagsArray  = array();
        $tags       = Tags::get();

        foreach ($tags as $key => $value) {
            $tagsArray[$value->name] = null;
        }

        return $tagsArray;
    }

    public function GenerateUsedTags($id) {
        $tagsArray = [];
        $tags = Works::find($id)->tags()->pluck('name')->toArray();

        foreach ($tags as $key => $value) {
            $tagsArray[$key]['tag'] = $value;
        }

        return $tagsArray;

    }
}
