<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class PostController extends Controller
{
private $_post;
    public function __construct(Post $post)
    {
        $this->_post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function creatPost(Request $request)
    {
            $validator = Validator::make($request->all(),[
                'user_id' => 'required',
                'name'=>'required',
                'title' => 'required',
                'description' => 'required'
            ]);
            if($validator->fails()){
                return response()->json(['error'=>$validator->errors()],401);
            }
            $postdata = $request->all();
        $post = Post::create($postdata);
        if($post == false) {
            return response()->json(['error' => 'error during process', 'status:' => "0"]);
        }
        return response()->json(['message' => 'post create successfully','status'=>"1"]);
//
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function postDelete(Request $request)
    {
        $post_id = $request->post_id;
        $postDelete = $this->_post->removePost($post_id);
        if($postDelete == false) {
            return response()->json(['error' => 'error during process']);
        }
        return response()->json(['message' => 'successfully delete']);
    }
    public function updatePost(Request $request){

        $updatepost = $request->all();
        $response = $this->_post->updatPost($updatepost);
        if($response == false) {
            return response()->json(['error' => 'error during process or data missing']);
        }
        return response()->json(['message' => 'successfully update post']);
    }
   public function getallPost(){
       $postArray = array();
        $post = $this->_post->getPost();
        foreach ($post as $posts){
            $data['user_id'] = $posts->user_id;
            $data['Post_name'] = $posts->name;
            $data['Post_title'] = $posts->title;
            $data['Post_description'] = $posts->description;
            array_push($postArray,$data);
        }
       if($postArray == false) {
           return response()->json(['error' => 'no data found']);
       }
       return response()->json(['data' => $postArray]);

   }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
