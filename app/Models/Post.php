<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id','name', 'title','description',
    ];

    public function removePost($post_id)
    {
        $post_id = self::find($post_id);
        $result = $post_id->delete();
        return $result;
    }
    public function updatPost($postData)
    {
        self::where('id',$postData['post_id'])->update(['user_id'=>$postData['user_id'],'name'=>$postData['name'],'title'=>$postData['title'],'description'=>$postData['description']]);
        $result = self::where('id',$postData['post_id'])->first();
        return $result;
    }
    public function getPost(){
        $post = self::all();
        return $post;
    }
    public function user(){
        $this->hasMany('App\User');
    }
}
