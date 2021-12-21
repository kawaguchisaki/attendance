@extends('layouts.admin')

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
                            {{ $user->name }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4">メールアドレス</label>
                        <div class="col-8">
                            {{ $user->email }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4">アイコン</label>
                        <div class="col-8">
                            <div class="form-text text-info">
                                設定中：{{ $user->icon_path }}
                            </div>
                            <input type="file" class="form-control-file" name="icon_path">
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