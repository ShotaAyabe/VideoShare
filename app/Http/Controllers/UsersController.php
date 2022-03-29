<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Follower;

use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index(User $user)
    {
        $all_users = $user->getAllUsers(auth()->user()->id);

        return view('users.index', [
            'all_users'  => $all_users
        ]);
    }
/*ユーザを取得するgetAllUsers()というメソッドに
ログインしているユーザIDを引数で渡す。
Modelから返ってきた結果をViewに返す。*/


    // フォロー
    public function follow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);
        }
        return redirect("/users");
    }

    // フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($user->id);

        }
        return redirect("/users");

    }
    
    /*
    $userと被るので$login_userを自身の情報とする。
    $login_userを元にフォロバ関連の判定をする。
    $timelinesはユーザのツイート情報。
    $~~countはカウント関連。
    */
    
    public function show(User $user, Tweet $tweet, Follower $follower)
    {
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($user->id);
        $is_followed = $login_user->isFollowed($user->id);
        $timelines = $tweet->getUserTimeLine($user->id);
        $tweet_count = $tweet->getTweetCount($user->id);
        $follow_count = $follower->getFollowCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);

        return view('users.show', [
            'user'           => $user,
            'is_following'   => $is_following,
            'is_followed'    => $is_followed,
            'timelines'      => $timelines,
            'tweet_count'    => $tweet_count,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }    
    
    
    /*
    $requestで取得したデータをValidator::makeでバリデーション設定。
    Rule::unique...でユニーク設定にしている
    screen_nameやemailを自身のIDの時だけ無効にする。
    バリデーションで弾かれるのを防ぐ。
    */
    
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'screen_name'   => ['required', 'string', 'max:50', Rule::unique('users')->ignore($user->id)],
            'name'          => ['required', 'string', 'max:255'],
            'profile_image' => ['mimes:jpeg,png,jpg'],
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)]
        ]);
        
        
        $validator->validate();
        $user->updateProfile($data);

        return redirect('users/'.$user->id);
    }    
}