@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
 {{--ツイート/フォロー/フォロワー数などを表示--}}        
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="d-inline-flex">
                    <div class="p-3 d-flex flex-column">
                        <img src="{{ $user->profile_image }}" class="rounded-circle" width="100" height="100">
                        <div class="mt-3 d-flex flex-column">
                            <h4 class="mb-0 font-weight-bold">{{ $user->name }}</h4>
                            <span class="text-secondary">{{ $user->screen_name }}</span>
                        </div>
                    </div>
                    <div class="p-3 d-flex flex-column justify-content-between">
                        <div class="d-flex">
                            <div>
                                @if ($user->id === Auth::user()->id)
                                    <a href="{{ url('users/' .$user->id .'/edit') }}" class="btn btn-primary">プロフィールを編集する</a>
                                @else
                                    @if ($is_following)
                                        <form action="/users/{{$user->id}}/unfollow" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">フォロー解除</button>
                                        </form>
                                    @else
                                        <form action="/users/{{$user->id}}/follow" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-primary">フォローする</button>
                                        </form>
                                    @endif
                                    @if ($is_followed)
                                        <span class="mt-2 px-1 bg-secondary text-light">フォローされています</span>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="p-2 d-flex flex-column align-items-center">
                                <p class="font-weight-bold">ツイート数</p>
                                <span>{{ $tweet_count }}</span>
                            </div>
                            <div class="p-2 d-flex flex-column align-items-center">
                                <p class="font-weight-bold">フォロー数</p>
                                <span>{{ $follow_count }}</span>
                            </div>
                            <div class="p-2 d-flex flex-column align-items-center">
                                <p class="font-weight-bold">フォロワー数</p>
                                <span>{{ $follower_count }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 <!--動画-->
        @if (isset($timelines))
            @foreach ($timelines as $timeline)
                <div class="col-md-8 mb-3">
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            <img src="{{ $timeline->user->profile_image }}" class="rounded-circle" width="50" height="50">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $timeline->user->name }}</p>
                                <a href="{{ url('users/' .$timeline->user->id) }}" class="text-secondary">{{ $timeline->user->screen_name }}</a>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $timeline->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <div class="card-body">
 {{--                        
                            <a href="{{ $timeline->url }}">
                            {!! nl2br(e($timeline->url)) !!}
                            </a>
--}}
                            <a href="" class="card card-w-image rounded-0 open-player disabled" data-url="{{ $timeline->url }}" data-start="0" data-end="11812" data-fname="scare jump ur whalecome" style="margin-bottom: 10px;">
                                <div class="row no-gutters">
                                    <div class="col-4 col-md-2">
                                        <!--サムネイルを表示する-->
                                        <div class="card-thumbnail">
                                            <img src="" class="img-fluid" alt="" style="padding: 3px;">
                                        </div>
                                    </div>
                                    <div class="col-8 col-md-10">
                                        <div class="card-body">
                                         <!--タイトル-->
                                            <h3 class="card-heading mb0" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">YouTubeテーマソング／ヒカキン＆セイキン</h3>
                                        <!--チャンネル名を表示させたい-->
                                            <div class="card-author text-muted" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">HikakinTV</div>
                                        <!--投稿日時を表示する-->    
                                            <div class="card-author text-muted">
                                                <i class="fa fa-clock-o m-r-xs"></i>
                                                 2000/00/00
                                                 <!--投稿日時を表示したいか、共有日時を表示したいかを考える-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <br>
                            {!! nl2br(e($timeline->text)) !!}
                        </div>
                        <div class="card-footer py-1 d-flex justify-content-end bg-white">
                            @if ($timeline->user->id === Auth::user()->id)
                                <div class="dropdown mr-3 d-flex align-items-center">
                                    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-fw"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a href="{{ url('tweets/' .$timeline->id .'/edit') }}" class="dropdown-item">編集</a>
                                        <form method="POST" action="{{ url('tweets/' .$timeline->id) }}" class="mb-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item del-btn">削除</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                            <div class="mr-3 d-flex align-items-center">
                                <a href="{{ url('tweets/' .$timeline->id) }}"><i class="far fa-comment fa-fw"></i></a>
                                <p class="mb-0 text-secondary">{{ count($timeline->comments) }}</p>
                            </div>
 {{--いいね処理追記--}}                            
                            <div class="d-flex align-items-center">
                                @if (!in_array($user->id, array_column($timeline->favorites->toArray(), 'user_id'), TRUE))
                                    <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
                                        @csrf
                                        <input type="hidden" name="tweet_id" value="{{ $timeline->id }}">
                                        <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"></i></button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ url('favorites/' .array_column($timeline->favorites->toArray(), 'id', 'user_id')[$user->id]) }}" class="mb-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i></button>
                                    </form>
                                @endif
                                <p class="mb-0 text-secondary">{{ count($timeline->favorites) }}</p>
                            </div>
{{--いいね処理追記--}}                            
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        
    </div>
    <div class="my-4 d-flex justify-content-center">
        {{ $timelines->links() }}
    </div>
<!--　必要だった部分　-->
<!--　動画プレイヤーの部分　-->
        <div class="player">
            <!-- プレイヤー部分 -->
            <div id="youtube" class="iframe"></div>
            
            <!-- 動画の閉じるボタン -->
            <div class="controller">
                <div class="close-player" title="プレイヤーを閉じる">
                    <i class="fa fa-2x fa-times-circle"></i>
                </div>
            </div>
            <!-- なくても良さそう -->
            <!--<div class="reclist"></div>-->
        </div>
    
</div>
@endsection