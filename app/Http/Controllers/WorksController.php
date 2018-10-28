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
            // if (!$slugID) {
            //     abort(404);
            // }
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

    private function getWorks(){
        $Works = Works::select('works.*')
                        ->where('works.status', '=', 1)
                        ->orderBy('works.id', 'desc')->offset($this->offset)->limit($this->limit)->get();
        $Works->toArray();

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

    private function generateTags($Works){
        foreach ($Works as $key => $value) {
            $Works->tags = Works::find($value->id)->tags()->pluck('name')->toArray();
            if ($value->video) {
                $value->video_thumb = Helper::GenerateVideoThumb($value->video);
            }
        }
    }

    public function getProject(Request $request){

        $workId = $request->input('id');

        $work = Works::where('id', $workId)->first();

        if ($work->video) {
            $work->video_embed = Helper::GenerateVideoEmbed($work->video);
        }
        
        $tags = Works::find($workId)->tags()->pluck('name')->toArray();

        $data = [
            'work' => $work,
            'tags' => $tags
        ];
        
        return view('shared.popup', $data);
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
}
