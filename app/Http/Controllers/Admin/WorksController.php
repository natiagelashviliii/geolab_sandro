<?php



namespace App\Http\Controllers\Admin;



use App\Helper;

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



        foreach ($Works as $key => $value) {

            $Works->tags = Works::find($value->id)->tags()->pluck('name')->toArray();

            if ($value->video) {

                $value->video_thumb = Helper::GenerateVideoThumb($value->video);

            }

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



        //get data



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



    public function deletephoto(Request $request) {

        return json_encode(['message' => 'ok']);

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

                'extension'   => '',

                'video'       => ''

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



        $fileNameToStore = '';

        $ext = '';

        if ($request->hasFile('File')) {

            $fileNameWithExt = $request->file('File')->getClientOriginalName();

            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            $ext = $request->file('File')->getClientOriginalExtension();

            $fileNameToStore = $fileName . '_' . time() . '.' . $ext;

            $path = $request->file('File')->storeAs('public/works', $fileNameToStore);



        }

        DB::table('works')->where('id', $workID)->update(['file' => $fileNameToStore, 'extension' => $ext]);



        if ($request->input('Video')) {

            $video = Helper::GenerateVimeoEmbed($request->input('Video'));

            DB::table('works')->where('id', $workID)->update(['video' => $video]);

        }



        return redirect()->route('admin.works.index');

    }



    public function EditWork(Request $request) {

        $this->validate($request, [

            'Title'       => 'required',

            'Description' => 'required',

            'CatID'       => 'required'

        ]);

        

        $workID = $request->input('WorkID');



        Works::where('id', $workID)

            ->update(

                [

                    'title'       => $request->input('Title'),

                    'description' => $request->input('Description'),

                    'cat_id'      => $request->input('CatID'),

                    'file'        => '',

                    'video'       => ''

                ]

            );



        // Delete related tags from work_tags table



        DB::table('work_tags')->where('work_id', $workID)->delete();



        // Update Tags table, And insert 



        $this->InsertWorkTags($workID, $request->input('Tags'));



        // Update File



        $fileNameToStore = '';

        $ext = '';

        if ($request->hasFile('File')) {

            $fileNameWithExt = $request->file('File')->getClientOriginalName();

            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            $ext = $request->file('File')->getClientOriginalExtension();

            $fileNameToStore = $fileName . '_' . time() . '.' . $ext;

            $path = $request->file('File')->storeAs('public/works', $fileNameToStore);



            DB::table('works')->where('id', $workID)->update(['file' => $fileNameToStore, 'extension' => $ext]);



        } else if($request->input('Video')) {

            $video = Helper::GenerateVimeoEmbed($request->input('Video'));

            DB::table('works')->where('id', $workID)->update(['video' => $video]);

        }



        return redirect()->route('admin.works.index');



    }



    public function Delete(Request $request) {

        $query = DB::table('works')->where('id', $request->input('WorkID'))->update(['status' => 2]);



        return ['success' => $query];

    }



    public function ChangeStatus(Request $request) {

        

        $work = Works::select('status')->where('id', $request->input('WorkID'))->first();

        $status = ($work->status == 0) ? 1 : 0;

        if (Works::where('id', $request->input('WorkID'))->update(['status' =>  $status])) {

            return ['success' => true];

        } else {

            return ['success' => false];

        }

    }



    //help functions



    private function GetTags() {

        $tagsArray  = array();

        $tags       = Tags::get();



        foreach ($tags as $key => $value) {

            $tagsArray[$value->name] = null;

        }



        return $tagsArray;

    }



    private function GenerateUsedTags($id) {

        $tagsArray = [];

        $tags = Works::find($id)->tags()->pluck('name')->toArray();



        foreach ($tags as $key => $value) {

            $tagsArray[$key]['tag'] = $value;

        }



        return $tagsArray;



    }



    private function InsertWorkTags($workID, $tags) {

        $Tags = explode(',', $tags);



        if (!empty($Tags)) {

            foreach ($Tags as $key => $value) {

                Tags::firstOrCreate(['name' => $value]);

                $tag = Tags::where('name', $value)->first();



                DB::table('work_tags')->insert(

                    ['work_id' => $workID, 'tag_id' => $tag->id]

                );

            }

        }

    }



}

