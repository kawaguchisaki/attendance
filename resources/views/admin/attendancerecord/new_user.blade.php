@extends('layouts.admin')

@section('title','従業員登録')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <h2>従業員登録</h2>
                <form action="{{ action('Admin\AttendanceController@new_user') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-4">従業員名</label>
                        <div class="col-8">
                            <input type="text" class="form-control" name="name" autocomplete=off value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4">メールアドレス</label>
                        <div class="col-8">
                            <input type="text" class="form-control" name="email" autocomplete=off value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4">パスワード</label>
                        <div class="col-8">
                            <input type="text" class="form-control" name="password" autocomplete=off value="{{ old('password') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4">アイコン画像</label>
                        <div class="col-8">
                            <input type="file" class="form-control-file" name="icon_path">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="登録">
                </form>
            </div>
        </div>
    </div>
@endsection