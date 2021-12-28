@extends('layouts.admin')

@section('title','CSV従業員登録確認')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <h2>登録内容確認</h2>
                <form action="{{ action('Admin\AttendanceController@import_user_check') }}" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="list-site col-12 mx-auto">
                            <div class="row">
                                <div class="col">
                                    @foreach($import_users as $import_user)
                                    <input type="text" class="form-control" name="user" autocomplete="off" value="{{ $import_user[0] }}">
                                    <input type="text" class="form-control" name="email" autocomplete="off" value="{{ $import_user[1] }}">
                                    <input type="text" class="form-control" name="password" autocomplete="off" value="{{ $import_user[2] }}">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="登録">
                </form>
            </div>
        </div>
    </div>
@endsection