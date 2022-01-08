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
                            <input type="text" class="form-control" name="name" autocomplete=off value="{{ $user->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4">メールアドレス</label>
                        <div class="col-8">
                            <input type="text" class="form-control" name="name" autocomplete=off value="{{ $user->email }}">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="編集">
                </form>
            </div>
        </div>
    </div>

@endsection