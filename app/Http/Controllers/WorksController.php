<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Works;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class WorksController extends Controller
{
    private $offset = 0;
    private $limit = 6;
    private $filter = '';

    public function __construct()
    {
        
    }

    public function index($slugFilter = '') {
        
        $this->filter = str_replace('-', ' ', $slugFilter);

        $slugID = 0;

    	if ($this->filter) {
            $Works = $this->getFilteredWorks();
            $slugID = DB::table('categories')->where('title', $this->filter)->first()->id;
            if (!$slugID) {
                abort(404);
            }
    	} else {
    		$Works = $this->getWorks();
        }
        
    	$Contact    = Contact::where('id', 1)->first();
    	$Categories = DB::table('categories')->where('status', '1')->get();

    	$Data = [
    		'Mode'    	 => Session::has('mode') ? Session::get('mode') : false ,
    		'Socials' 	 => json_decode($Contact['socials'], true),
    		'Categories' => $Categories,
    		'Works'		 => $Works,
            'slugID'     => $slugID
    	];

    	return view('works/index', $Data);

    }

    public function explore($tag = null) {
        $tagId = DB::table('tags')->where('name', $tag)->first()->id;

        if (!$tagId) {
            abort('404');
        }

        $Contact    = Contact::where('id', 1)->first();
        $Categories = DB::table('categories')->where('status', '1')->get();

        $Data = [
            'Mode'       => Session::has('mode') ? Session::get('mode') : false ,
            'Socials'    => json_decode($Contact['socials'], true),
            'Categories' => $Categories,
            'tag'        => $tag
        ];

        return view('works/explore', $Data);
    }

    private function getWorks(){
        $Works = Works::select('works.*')
                        ->where('works.status', '=', 1)
                        ->orderBy('works.id', 'desc')->offset($this->offset)->limit($this->limit)->get();
        $Works->toArray();

        foreach ($Works as $key => $value) {
            if ($value->video) {
                $value->video_embed = Helper::GenerateVideoEmbed($value->video);
            }
        }


        $this->generateTags($Works);

        return $Works;
    }

    private function getFilteredWorks(){
        $slug = str_replace('-', ' ', $this->filter);
        $Works = Works::select('works.*')
                        ->where('works.status', '=', 1)
                        ->where('categories.title', $slug)
                        ->join('categories','works.cat_id','=','categories.id')
                        ->orderBy('works.id', 'desc')
                        ->offset($this->offset)->limit($this->limit)->get();
        $Works->toArray();

        $this->generateTags($Works);

        return $Works;
    }

    public function getProject(Request $request){

        $workId = $request->input('id');
        if ($request->input('slugId') != 0) {
            $data = $this->getProjectData($workId, $request->input('slugId'));
        } else {
            $data = $this->getProjectData($workId);
        }
        
        return view('shared.popup', $data);
    }

    public function getProjectContent(Request $request){

        $workId = $request->input('id');

        if ($request->input('slugId') != 0) {
            $data = $this->getProjectData($workId, $request->input('slugId'));
        } else {
            $data = $this->getProjectData($workId);
        }

        return view('works.inc.popup-content', $data);
    }

    public function getSiblingProjects(Request $request){
        $workId = $request->input('id');

        if ($request->input('slugId') != 0) {
            $previous = Works::where('id', '>', $workId)->where('status', '=', '1')->where('cat_id', '=', $slugId)->min('id');
            $next = Works::where('id', '<', $workId)->where('status', '=', '1')->where('cat_id', '=', $slugId)->max('id');

        } else {
            $previous = Works::where('id', '>', $workId)->where('status', '=', '1')->min('id');
            $next = Works::where('id', '<', $workId)->where('status', '=', '1')->max('id');
        }

        $data = [
            'previous' => $previous,
            'next' => $next
        ];

        return json_encode($data);
    }

    public function loadProjects(Request $request) {
        $this->offset = $request->input('offset');

        if ($request->input('slug')) {
            $this->filter = str_replace('-', ' ', $request->input('slug'));
            $Works=$this->getFilteredWorks();
        }else{
            $Works = $this->getWorks();
        }

        $Data = [
            'Works' => $Works
        ];

        return view('works/works', $Data);
    }


    //help functions

    public function getProjectData($workId, $slugId = null){
        
        $work = Works::where('id', $workId)->first();

        if ($work->video) {
            $work->video_embed = Helper::GenerateVideoEmbed($work->video);
        }
        
        $tags = Works::find($workId)->tags()->pluck('name')->toArray();

        if ($slugId) {
            $previous = Works::where('id', '>', $work->id)->where('status', '=', '1')->where('cat_id', '=', $slugId)->min('id');
            $next = Works::where('id', '<', $work->id)->where('status', '=', '1')->where('cat_id', '=', $slugId)->max('id');

        } else {
            $previous = Works::where('id', '>', $work->id)->where('status', '=', '1')->min('id');
            $next = Works::where('id', '<', $work->id)->where('status', '=', '1')->max('id');
        }
        

        $data = [
            'work' => $work,
            'tags' => $tags,
            'previous' => $previous,
            'next' => $next,
            'slugId' => $slugId ? $slugId : false ,
        ];

        return $data;
    }

    private function generateTags($Works){
        foreach ($Works as $key => $value) {
            $Works->tags = Works::find($value->id)->tags()->pluck('name')->toArray();
            if ($value->video) {
                $value->video_thumb = Helper::GenerateVideoThumb($value->video);
            }
        }
    }

    // private function getWorksByTags() {
        
    // }
}
