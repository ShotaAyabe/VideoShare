<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text'
    ];

    /*relation*/
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /*getTweet()で取得した情報に紐づいた
    コメント情報を取得*/
    
    public function getComments(Int $tweet_id)
    {
        return $this->with('user')->where('tweet_id', $tweet_id)->get();
    }
    
    
    /*Controllerからバリデーションを通した後、データを保存。
    引数にはコメントした$user_idとコメントのデータ$dataを設定*/
    
    public function commentStore(Int $user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->tweet_id = $data['tweet_id'];
        $this->text = $data['text'];
        $this->save();

        return;
    }
    
    
}