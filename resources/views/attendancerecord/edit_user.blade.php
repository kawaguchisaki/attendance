@extends('layouts.user')

@section('title','プロフィール編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <h2>プロフィール編集</h2>
                <form action="{{ action('AttendanceController@update_user') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-4">名前</label>
                        <div class="col-8">
                            <p>{{ $user->name }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4">メールアドレス</label>
                        <div class="col-8">
                            変更前：{{ $user->email }}
                        </div>
                        <label class="col-4"></label>
                        <div class="col-8">
                            変更後：<input type="text" size=20 name='email' placeholder="新しいメールアドレス" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4">アイコン</label>
                        <div class="col-8">
                            <input type="file" class="form-control-file" name="icon_path">
                            <div class="form-text text-info">
                                設定中: {{ $user->icon_path }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                        
                        
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="編集">
                </form>
            </div>
        </div>
    </div>

@endsection