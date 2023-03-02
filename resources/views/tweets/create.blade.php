@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tweets.store') }}" name="form1">
                        @csrf
                        <div class="form-group row mb-0">
                            <div class="col-md-12 p-3 w-100 d-flex">
                                <img src="{{ $user->profile_image }}" class="rounded-circle" width="50" height="50">
                                <div class="ml-2 d-flex flex-column">
                                    <p class="mb-0">{{ $user->name }}</p>
                                    <a href="{{ url('users/' .$user->id) }}" class="text-secondary">{{ $user->screen_name }}</a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="">共有したいYouTube動画のURLを入力してください</label>
                                <textarea class="form-control @error('url') is-invalid @enderror" name="url" required autocomplete="url" rows="1">{{ old('url') }}</textarea>
                                <label for="">共有メッセージを入力してください<span1>(140字以内)</span1></label>
                                <textarea class="form-control @error('text') is-invalid @enderror" name="text" required autocomplete="text" rows="4">{{ old('text') }}</textarea>
                                
                                <input type="hidden" id="thumbnail" name="thumbnail" readonly/>
                                <input type="hidden" id="title" name="title" readonly/>
                                
                                <label for="">情報の取得に成功すると、動画のチャンネル名が表示されます...</label>
                                <br/>
                                <label for="">チャンネル名:</label>
                                <input type="text" id="author" name="author" style="border: none" readonly/>
                                @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <div name="error"></div>
                                <button type="submit" class="btn btn-primary">
                                    動画を共有する
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection